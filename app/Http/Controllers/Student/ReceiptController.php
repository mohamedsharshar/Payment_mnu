<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\StudentReceiptsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

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

        // البحث بالتاريخ من
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        // البحث بالتاريخ إلى
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // البحث بحالة الإيصال
        if ($request->filled('status')) {
            $query->where('BillStatus', $request->status);
        }

        // البحث بنوع الخدمة
        if ($request->filled('service_type')) {
            $query->where('ServiceType_ID', $request->service_type);
        }

        // البحث برقم الإيصال
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ID', 'like', "%{$search}%");
            });
        }

        $receipts = $query->orderBy('created_at', 'desc')->paginate(15);

        // جلب جميع أنواع الخدمات المستخدمة من قبل الطالب
        $serviceIds = $customer->bills()->distinct()->pluck('ServiceType_ID');
        $services = \App\Models\Service::whereIn('ID', $serviceIds)->get();

        return view('student.receipts.index', compact('customer', 'receipts', 'services'));
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

        // تطبيق نفس فلاتر البحث
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('status')) {
            $query->where('BillStatus', $request->status);
        }

        if ($request->filled('service_type')) {
            $query->where('ServiceType_ID', $request->service_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ID', 'like', "%{$search}%");
            });
        }

        $receipts = $query->orderBy('created_at', 'desc')->get();

        $fileName = 'receipts_' . $customer->Code . '_' . date('Y-m-d') . '.xlsx';

        return Excel::download(new StudentReceiptsExport($receipts, $customer), $fileName);
    }

    public function exportPdf(Request $request)
    {
        $user = Auth::user();
        $customer = $user->customer;

        if (!$customer) {
            return redirect()->route('student.dashboard')->with('error', 'لا يوجد بيانات طالب مرتبطة بحسابك');
        }

        $query = $customer->bills()->with('service');

        // تطبيق نفس فلاتر البحث
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('status')) {
            $query->where('BillStatus', $request->status);
        }

        if ($request->filled('service_type')) {
            $query->where('ServiceType_ID', $request->service_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ID', 'like', "%{$search}%");
            });
        }

        $receipts = $query->orderBy('created_at', 'desc')->get();

        // حساب الإحصائيات
        $stats = [
            'total' => $receipts->count(),
            'paid' => $receipts->where('BillStatus', 2)->count(),
            'pending' => $receipts->where('BillStatus', 1)->count(),
            'cancelled' => $receipts->where('BillStatus', 3)->count(),
            'total_amount' => $receipts->sum(function($bill) {
                return $bill->service ? $bill->service->value : 0;
            })
        ];

        $pdf = Pdf::loadView('student.receipts.pdf', compact('receipts', 'customer', 'stats'))
            ->setPaper('a4', 'portrait')
            ->setOption('encoding', 'utf-8');

        $fileName = 'receipts_' . $customer->Code . '_' . date('Y-m-d') . '.pdf';

        return $pdf->download($fileName);
    }
}
