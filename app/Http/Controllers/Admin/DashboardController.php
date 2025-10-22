<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Service;
use App\Models\EfPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_customers' => Customer::count(),
            'total_bills' => Bill::count(),
            'active_bills' => Bill::active()->notArchived()->count(),
            'total_payments' => EfPayment::count(),
            'total_revenue' => EfPayment::sum('Amount'),
            'pending_amount' => Bill::active()->notArchived()
                ->join('services', 'bills.ServiceType_ID', '=', 'services.ID')
                ->sum('services.value'),
        ];

        $recent_bills = Bill::with(['customer', 'service'])
            ->latest()
            ->take(5)
            ->get();

        $recent_payments = EfPayment::with(['bill', 'customer'])
            ->latest('Payment_Date')
            ->take(5)
            ->get();

        $services_stats = Service::withCount('bills')->get();

        $monthly_revenue = EfPayment::select(
            DB::raw('MONTH(Payment_Date) as month'),
            DB::raw('SUM(Amount) as total')
        )
        ->whereYear('Payment_Date', date('Y'))
        ->groupBy('month')
        ->get();

        return view('admin.dashboard', compact('stats', 'recent_bills', 'recent_payments', 'services_stats', 'monthly_revenue'));
    }
}
