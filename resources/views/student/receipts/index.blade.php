@extends('layouts.student')

@section('title', 'الإيصالات - بوابة الطالب')
@section('page-title', 'الإيصالات')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-search me-2"></i>البحث والتصفية
            </div>
            <div class="card-body">
                <form action="{{ route('student.receipts.search') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">من تاريخ</label>
                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">إلى تاريخ</label>
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                        </div>

                        <div class="col-md-3 mb-3">
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

                        <div class="col-md-3 mb-3">
                            <label class="form-label">حالة الإيصال</label>
                            <select name="status" class="form-select">
                                <option value="">الكل</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>معلق</option>
                                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>مدفوع</option>
                                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>ملغي</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">رقم الإيصال</label>
                            <input type="text" name="search" class="form-control" placeholder="ابحث برقم الإيصال" value="{{ request('search') }}">
                        </div>

                        <div class="col-md-6 mb-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="bi bi-search me-2"></i>بحث
                            </button>
                            <a href="{{ route('student.receipts.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-x-circle me-2"></i>إعادة تعيين
                            </a>
                            @if($receipts->count() > 0)
                            <a href="{{ route('student.receipts.export', request()->all()) }}" class="btn btn-success me-2">
                                <i class="bi bi-file-earmark-excel me-2"></i>Excel
                            </a>
                            <a href="{{ route('student.receipts.export.pdf', request()->all()) }}" class="btn btn-danger">
                                <i class="bi bi-file-earmark-pdf me-2"></i>PDF
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-receipt me-2"></i>قائمة الإيصالات</span>
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
                                <th>القيمة</th>
                                <th>الحالة</th>
                                <th>تاريخ الإنشاء</th>
                                <th>تاريخ الاستحقاق</th>
                                <th>تاريخ الدفع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($receipts as $receipt)
                            <tr>
                                <td><strong>#{{ $receipt->ID }}</strong></td>
                                <td>{{ $receipt->service ? $receipt->service->SERVICESName : 'غير محدد' }}</td>
                                <td><strong>{{ $receipt->service ? number_format($receipt->service->value, 2) . ' ج.م' : '-' }}</strong></td>
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
                                    @if($receipt->SettlementDate)
                                        {{ $receipt->SettlementDate }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
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
                        {{ $receipts->links() }}
                    </div>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 4rem; color: #dee2e6;"></i>
                    <h5 class="mt-3 text-muted">لا توجد إيصالات</h5>
                    <p class="text-muted">
                        @if(request()->hasAny(['date_from', 'date_to', 'status', 'search']))
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
