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

<!-- قسم البحث في الإيصالات -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-search me-2"></i>البحث في إيصالات الكلية
            </div>
            <div class="card-body">
                <form action="{{ route('student.faculty') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">من تاريخ</label>
                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">إلى تاريخ</label>
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">نوع الإيصال (الخدمة)</label>
                            <select name="service_type" class="form-select">
                                <option value="">الكل</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->ID }}" {{ request('service_type') == $service->ID ? 'selected' : '' }}>
                                        {{ $service->SERVICESName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="bi bi-search me-2"></i>بحث
                            </button>
                            <a href="{{ route('student.faculty') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-x-circle me-2"></i>إعادة تعيين
                            </a>
                            @if($receipts->count() > 0)
                            <a href="{{ route('student.faculty.export.pdf', request()->all()) }}" class="btn btn-danger">
                                <i class="bi bi-file-earmark-pdf me-2"></i>تصدير PDF
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- قسم عرض الإيصالات -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-receipt me-2"></i>إيصالات الكلية</span>
                <span class="badge" style="background: var(--primary-color);">{{ $receipts->total() }} إيصال</span>
            </div>
            <div class="card-body">
                @if($receipts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>رقم الإيصال</th>
                                <th>نوع الخدمة</th>
                                <th>الحالة</th>
                                <th>تاريخ الإنشاء</th>
                                <th>تاريخ الاستحقاق</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($receipts as $receipt)
                            <tr>
                                <td><strong>#{{ $receipt->ID }}</strong></td>
                                <td>{{ $receipt->service ? $receipt->service->SERVICESName : 'غير محدد' }}</td>
                                <td>
                                    @if($receipt->BillStatus == 1)
                                        <span class="badge badge-warning">
                                            <i class="bi bi-clock me-1"></i>معلق
                                        </span>
                                    @elseif($receipt->BillStatus == 2)
                                        <span class="badge badge-success">
                                            <i class="bi bi-check-circle me-1"></i>مدفوع
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            <i class="bi bi-x-circle me-1"></i>ملغي
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $receipt->created_at ? $receipt->created_at->format('Y-m-d') : 'غير محدد' }}</td>
                                <td>{{ $receipt->DueDate ? date('Y-m-d', strtotime($receipt->DueDate)) : 'غير محدد' }}</td>
                                <td>
                                    <a href="{{ route('student.receipts.index') }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye me-1"></i>عرض التفاصيل
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        عرض {{ $receipts->firstItem() }} إلى {{ $receipts->lastItem() }} من {{ $receipts->total() }} إيصال
                    </div>
                    <div>
                        {{ $receipts->appends(request()->query())->links() }}
                    </div>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 4rem; color: #dee2e6;"></i>
                    <h5 class="mt-3 text-muted">لا توجد إيصالات</h5>
                    <p class="text-muted">
                        @if(request()->hasAny(['date_from', 'date_to', 'service_type']))
                            لم يتم العثور على إيصالات تطابق معايير البحث
                        @else
                            لا توجد إيصالات مسجلة حتى الآن
                        @endif
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
