@extends('layouts.student')

@section('title', 'بيانات الكلية - بوابة الطالب')
@section('page-title', 'بيانات الكلية')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-building me-2"></i>معلومات الكلية
            </div>
            <div class="card-body">
                @if($faculty)
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold text-muted mb-2">
                            <i class="bi bi-translate me-2"></i>الاسم بالعربي
                        </label>
                        <p class="fs-5">{{ $faculty->NameAR }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold text-muted mb-2">
                            <i class="bi bi-alphabet me-2"></i>الاسم بالإنجليزي
                        </label>
                        <p class="fs-5">{{ $faculty->NameEN ?? 'غير محدد' }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold text-muted mb-2">
                            <i class="bi bi-upc-scan me-2"></i>كود الكلية
                        </label>
                        <p class="fs-5">{{ $faculty->Code ?? 'غير محدد' }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold text-muted mb-2">
                            <i class="bi bi-bank me-2"></i>رقم الحساب
                        </label>
                        <p class="fs-5">{{ $faculty->AccountNumber ?? 'غير محدد' }}</p>
                    </div>

                    @if($faculty->Note)
                    <div class="col-md-12 mb-3">
                        <label class="fw-bold text-muted mb-2">
                            <i class="bi bi-sticky me-2"></i>ملاحظات
                        </label>
                        <p class="fs-5">{{ $faculty->Note }}</p>
                    </div>
                    @endif
                </div>

                <div class="alert" style="background: var(--pale-blue); color: var(--primary-color); border: none;">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <strong>معلومة:</strong> هذه البيانات مرتبطة بحسابك الأكاديمي ولا يمكن تعديلها من خلال البوابة.
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-building" style="font-size: 4rem; color: #dee2e6;"></i>
                    <h5 class="mt-3 text-muted">لا توجد بيانات كلية مرتبطة بحسابك</h5>
                    <p class="text-muted">يرجى التواصل مع الإدارة لربط حسابك بالكلية المناسبة</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-badge me-2"></i>بيانات الطالب في النظام
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold text-muted mb-2">
                            <i class="bi bi-hash me-2"></i>كود الطالب
                        </label>
                        <p class="fs-5">{{ $customer->Code }}</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold text-muted mb-2">
                            <i class="bi bi-person me-2"></i>الاسم
                        </label>
                        <p class="fs-5">{{ $customer->Name }}</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold text-muted mb-2">
                            <i class="bi bi-envelope me-2"></i>البريد الإلكتروني
                        </label>
                        <p class="fs-5">{{ $customer->Email ?? 'غير محدد' }}</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold text-muted mb-2">
                            <i class="bi bi-phone me-2"></i>رقم الهاتف
                        </label>
                        <p class="fs-5">{{ $customer->Mobile ?? 'غير محدد' }}</p>
                    </div>

                    @if($customer->Description)
                    <div class="col-md-8 mb-3">
                        <label class="fw-bold text-muted mb-2">
                            <i class="bi bi-card-text me-2"></i>وصف
                        </label>
                        <p class="fs-5">{{ $customer->Description }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
