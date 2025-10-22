@extends('layouts.admin')

@section('title', 'إدارة المدفوعات')
@section('page-title', 'إدارة المدفوعات')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card purple">
            <div class="icon">
                <i class="bi bi-credit-card"></i>
            </div>
            <h6>إجمالي المدفوعات</h6>
            <h3>{{ $payments->total() }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card blue">
            <div class="icon">
                <i class="bi bi-cash-stack"></i>
            </div>
            <h6>إجمالي المبالغ</h6>
            <h3>{{ number_format($total_amount, 2) }} <small>ج.م</small></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card light">
            <div class="icon">
                <i class="bi bi-calendar-check"></i>
            </div>
            <h6>مدفوعات اليوم</h6>
            <h3>{{ $today_payments }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card purple">
            <div class="icon">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
            <h6>مبالغ اليوم</h6>
            <h3>{{ number_format($today_amount, 2) }} <small>ج.م</small></h3>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-credit-card ms-2"></i> قائمة المدفوعات
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>رقم المعاملة</th>
                        <th>رقم الفاتورة</th>
                        <th>حساب الفوترة</th>
                        <th>المبلغ</th>
                        <th>تاريخ الدفع</th>
                        <th>طريقة الدفع</th>
                        <th>القناة</th>
                        <th>البنك</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td><strong>{{ $payment->Transaction_Number }}</strong></td>
                        <td><span class="badge badge-success">#{{ $payment->BillNumber }}</span></td>
                        <td>{{ $payment->Billing_Account }}</td>
                        <td><strong style="color: var(--primary-dark);">{{ number_format($payment->Amount, 2) }} ج.م</strong></td>
                        <td>{{ $payment->Payment_Date->format('Y-m-d H:i') }}</td>
                        <td>{{ $payment->Payment_Method ?? 'غير محدد' }}</td>
                        <td>
                            <span class="badge" style="background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));">
                                {{ $payment->Access_Channel }}
                            </span>
                        </td>
                        <td>{{ $payment->Bank_Id ?? 'غير محدد' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">لا توجد مدفوعات</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($payments->hasPages())
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted">
                عرض {{ $payments->firstItem() }} إلى {{ $payments->lastItem() }} من أصل {{ $payments->total() }} مدفوعة
            </div>
            <div>
                {{ $payments->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
