@extends('layouts.student')

@section('title', 'الصفحة الرئيسية - بوابة الطالب')
@section('page-title', 'الصفحة الرئيسية')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3"><i class="bi bi-person-badge me-2"></i>معلومات الطالب</h5>
                <div class="row">
                    <div class="col-md-3">
                        <strong>الكود:</strong>
                        <p>{{ $customer->Code }}</p>
                    </div>
                    <div class="col-md-3">
                        <strong>الاسم:</strong>
                        <p>{{ $customer->Name }}</p>
                    </div>
                    <div class="col-md-3">
                        <strong>البريد الإلكتروني:</strong>
                        <p>{{ $customer->Email ?? 'غير محدد' }}</p>
                    </div>
                    <div class="col-md-3">
                        <strong>رقم الهاتف:</strong>
                        <p>{{ $customer->Mobile ?? 'غير محدد' }}</p>
                    </div>
                </div>
                @if($customer->faculty)
                <div class="row mt-3">
                    <div class="col-md-12">
                        <strong>الكلية:</strong>
                        <p>{{ $customer->faculty->NameAR }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="icon" style="background: rgba(78, 113, 255, 0.1); color: var(--primary-color);">
                <i class="bi bi-receipt"></i>
            </div>
            <h3>{{ $totalBills }}</h3>
            <p>إجمالي الإيصالات</p>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="icon" style="background: rgba(56, 201, 89, 0.1); color: var(--success-color);">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h3>{{ $paidBills }}</h3>
            <p>الإيصالات المدفوعة</p>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="icon" style="background: rgba(255, 193, 7, 0.1); color: var(--warning-color);">
                <i class="bi bi-clock-fill"></i>
            </div>
            <h3>{{ $pendingBills }}</h3>
            <p>الإيصالات المعلقة</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-clock-history me-2"></i>آخر الإيصالات
            </div>
            <div class="card-body">
                @if($recentBills->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>رقم الإيصال</th>
                                <th>نوع الخدمة</th>
                                <th>الحالة</th>
                                <th>تاريخ الإنشاء</th>
                                <th>تاريخ الاستحقاق</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBills as $bill)
                            <tr>
                                <td><strong>#{{ $bill->ID }}</strong></td>
                                <td>{{ $bill->service ? $bill->service->Name : 'غير محدد' }}</td>
                                <td>
                                    @if($bill->BillStatus == 1)
                                        <span class="badge badge-warning">معلق</span>
                                    @elseif($bill->BillStatus == 2)
                                        <span class="badge badge-success">مدفوع</span>
                                    @else
                                        <span class="badge badge-danger">ملغي</span>
                                    @endif
                                </td>
                                <td>{{ $bill->created_at ? $bill->created_at->format('Y-m-d') : 'غير محدد' }}</td>
                                <td>{{ $bill->DueDate ? date('Y-m-d', strtotime($bill->DueDate)) : 'غير محدد' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('student.receipts.index') }}" class="btn btn-primary">
                        <i class="bi bi-eye me-2"></i>عرض جميع الإيصالات
                    </a>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #dee2e6;"></i>
                    <p class="text-muted mt-3">لا توجد إيصالات حتى الآن</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
