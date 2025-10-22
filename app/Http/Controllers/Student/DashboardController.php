<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Bill;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $customer = $user->customer;

        if (!$customer) {
            return redirect()->route('login')->with('error', 'لا يوجد بيانات طالب مرتبطة بحسابك');
        }

        $totalBills = $customer->bills()->count();
        $paidBills = $customer->bills()->where('BillStatus', 2)->count();
        $pendingBills = $customer->bills()->where('BillStatus', 1)->count();
        $recentBills = $customer->bills()
            ->with('service')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('student.dashboard', compact(
            'customer',
            'totalBills',
            'paidBills',
            'pendingBills',
            'recentBills'
        ));
    }
}
