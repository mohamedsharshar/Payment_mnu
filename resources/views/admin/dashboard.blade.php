@extends('layouts.admin')

@section('title', 'لوحة التحكم الرئيسية')
@section('page-title', 'لوحة التحكم')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <h6>إجمالي الطلاب</h6>
            <h3>{{ number_format($stats['total_customers']) }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon">
                <i class="bi bi-receipt"></i>
            </div>
            <h6>إجمالي الفواتير</h6>
            <h3>{{ number_format($stats['total_bills']) }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <h6>الفواتير النشطة</h6>
            <h3>{{ number_format($stats['active_bills']) }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon">
                <i class="bi bi-cash-stack"></i>
            </div>
            <h6>إجمالي الإيرادات</h6>
            <h3>{{ number_format($stats['total_revenue'], 2) }} <small>ج.م</small></h3>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-receipt ms-2"></i> آخر الفواتير</span>
                <a href="{{ route('admin.bills.index') }}" class="btn btn-sm btn-outline-primary">عرض الكل</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>رقم الفاتورة</th>
                                <th>الطالب</th>
                                <th>الخدمة</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_bills as $bill)
                            <tr>
                                <td><strong>#{{ $bill->ID }}</strong></td>
                                <td>{{ $bill->customer->Name ?? 'غير محدد' }}</td>
                                <td>{{ $bill->service->SERVICESName }}</td>
                                <td>
                                    @if($bill->BillStatus == 1)
                                        <span class="badge badge-success">نشط</span>
                                    @else
                                        <span class="badge badge-warning">معلق</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">لا توجد فواتير</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-credit-card ms-2"></i> آخر المدفوعات</span>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-sm btn-outline-primary">عرض الكل</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>رقم المعاملة</th>
                                <th>المبلغ</th>
                                <th>التاريخ</th>
                                <th>القناة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_payments as $payment)
                            <tr>
                                <td><strong>{{ $payment->Transaction_Number }}</strong></td>
                                <td><strong>{{ number_format($payment->Amount, 2) }} ج.م</strong></td>
                                <td>{{ $payment->Payment_Date->format('Y-m-d') }}</td>
                                <td><span class="badge badge-success">{{ $payment->Access_Channel }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">لا توجد مدفوعات</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
