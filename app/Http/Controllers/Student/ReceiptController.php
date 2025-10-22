<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\StudentReceiptsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReceiptController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $customer = $user->customer;

        if (!$customer) {
            return redirect()->route('student.dashboard')->with('error', 'لا يوجد بيانات طالب مرتبطة بحسابك');
        }

        $query = $customer->bills()->with('service');

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('status')) {
            $query->where('BillStatus', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ID', 'like', "%{$search}%");
            });
        }

        $receipts = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('student.receipts.index', compact('customer', 'receipts'));
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function export(Request $request)
    {
        $user = Auth::user();
        $customer = $user->customer;

        if (!$customer) {
            return redirect()->route('student.dashboard')->with('error', 'لا يوجد بيانات طالب مرتبطة بحسابك');
        }

        $query = $customer->bills()->with('service');

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('status')) {
            $query->where('BillStatus', $request->status);
        }

        $receipts = $query->orderBy('created_at', 'desc')->get();

        $fileName = 'receipts_' . $customer->Code . '_' . date('Y-m-d') . '.xlsx';

        return Excel::download(new StudentReceiptsExport($receipts, $customer), $fileName);
    }
}
