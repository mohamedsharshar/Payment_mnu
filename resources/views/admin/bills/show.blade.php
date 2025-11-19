@extends('layouts.admin')

@section('title', 'تفاصيل الفاتورة')
@section('page-title', 'تفاصيل الفاتورة')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-receipt ms-2"></i> فاتورة #{{ $bill->ID }}</span>
        <a href="{{ route('admin.bills.edit', $bill->ID) }}" class="btn btn-sm btn-light">
            <i class="bi bi-pencil"></i> تعديل
        </a>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4"><strong>الطالب:</strong></div>
            <div class="col-md-8">{{ $bill->customer->Name ?? '-' }} ({{ $bill->CustomerCode }})</div>

            <div class="col-md-4"><strong>الخدمة:</strong></div>
            <div class="col-md-8">{{ $bill->service->SERVICESName ?? '-' }}</div>

            <div class="col-md-4"><strong>القيمة:</strong></div>
            <div class="col-md-8">{{ $bill->service ? number_format($bill->service->value, 2) . ' ج.م' : '-' }}</div>

            <div class="col-md-4"><strong>تاريخ الاستحقاق:</strong></div>
            <div class="col-md-8">{{ $bill->DueDate ? $bill->DueDate->format('Y-m-d') : '-' }}</div>

            <div class="col-md-4"><strong>الحالة:</strong></div>
            <div class="col-md-8">
                @if($bill->BillStatus == 1)
                    <span class="badge badge-warning">معلق</span>
                @elseif($bill->BillStatus == 2)
                    <span class="badge badge-success">مدفوع</span>
                @else
                    <span class="badge badge-secondary">ملغي</span>
                @endif
            </div>

            <div class="col-md-4"><strong>تاريخ السداد:</strong></div>
            <div class="col-md-8">{{ $bill->SettlementDate ? $bill->SettlementDate->format('Y-m-d') : '-' }}</div>
        </div>
    </div>
    <div class="card-footer bg-white">
        <a href="{{ route('admin.bills.index') }}" class="btn btn-outline-secondary">رجوع</a>
    </div>
</div>
@endsection
