@extends('layouts.admin')

@section('title', 'تفاصيل الطالب')
@section('page-title', 'تفاصيل الطالب')

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-person-badge ms-2"></i> بيانات الطالب</span>
        <a href="{{ route('admin.customers.edit', $customer->Code) }}" class="btn btn-sm btn-light">
            <i class="bi bi-pencil"></i> تعديل
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3"><strong>الكود:</strong></div>
            <div class="col-md-9">{{ $customer->Code }}</div>

            <div class="col-md-3"><strong>الاسم:</strong></div>
            <div class="col-md-9">{{ $customer->Name }}</div>

            <div class="col-md-3"><strong>البريد الإلكتروني:</strong></div>
            <div class="col-md-9">{{ $customer->Email ?? 'غير محدد' }}</div>

            <div class="col-md-3"><strong>الجوال:</strong></div>
            <div class="col-md-9">{{ $customer->Mobile ?? 'غير محدد' }}</div>

            <div class="col-md-3"><strong>الكلية:</strong></div>
            <div class="col-md-9">{{ $customer->faculty->NameAR ?? 'غير محدد' }}</div>

            <div class="col-md-3"><strong>الوصف:</strong></div>
            <div class="col-md-9">{{ $customer->Description ?? '-' }}</div>
        </div>
    </div>
    <div class="card-footer bg-white">
        <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">رجوع</a>
    </div>

</div>

<div class="card">
    <div class="card-header"><i class="bi bi-receipt ms-2"></i> فواتير الطالب</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الخدمة</th>
                        <th>القيمة</th>
                        <th>تاريخ الاستحقاق</th>
                        <th>الحالة</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customer->bills as $bill)
                    <tr>
                        <td>{{ $bill->ID }}</td>
                        <td>{{ $bill->service->SERVICESName ?? '-' }}</td>
                        <td>{{ $bill->service ? number_format($bill->service->value, 2) . ' ج.م' : '-' }}</td>
                        <td>{{ $bill->DueDate ? $bill->DueDate->format('Y-m-d') : '-' }}</td>
                        <td>
                            @if($bill->BillStatus == 1)
                                <span class="badge badge-warning">معلق</span>
                            @elseif($bill->BillStatus == 2)
                                <span class="badge badge-success">مدفوع</span>
                            @else
                                <span class="badge badge-secondary">ملغي</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.bills.show', $bill->ID) }}"><i class="bi bi-eye"></i></a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.bills.edit', $bill->ID) }}"><i class="bi bi-pencil"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">لا توجد فواتير</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
