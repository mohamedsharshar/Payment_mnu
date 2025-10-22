<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EfPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = EfPayment::with(['bill', 'customer'])
            ->latest('Payment_Date')
            ->paginate(15);

        $total_amount = EfPayment::sum('Amount');
        $today_payments = EfPayment::whereDate('Payment_Date', today())->count();
        $today_amount = EfPayment::whereDate('Payment_Date', today())->sum('Amount');

        return view('admin.payments.index', compact('payments', 'total_amount', 'today_payments', 'today_amount'));
    }
}
