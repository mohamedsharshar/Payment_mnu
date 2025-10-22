@extends('layouts.admin')

@section('title', 'إدارة الفواتير')
@section('page-title', 'إدارة الفواتير')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-receipt ms-2"></i> قائمة الفواتير</span>
        <a href="{{ route('admin.bills.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle ms-2"></i> إنشاء فاتورة جديدة
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>رقم الفاتورة</th>
                        <th>كود الطالب</th>
                        <th>اسم الطالب</th>
                        <th>الخدمة</th>
                        <th>المبلغ</th>
                        <th>تاريخ الاستحقاق</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bills as $bill)
                    <tr>
                        <td><strong>#{{ $bill->ID }}</strong></td>
                        <td>{{ $bill->CustomerCode ?? 'غير محدد' }}</td>
                        <td>{{ $bill->customer->Name ?? 'غير محدد' }}</td>
                        <td>{{ $bill->service->SERVICESName }}</td>
                        <td><strong>{{ number_format($bill->service->value, 2) }} ج.م</strong></td>
                        <td>{{ $bill->DueDate ? $bill->DueDate->format('Y-m-d') : 'غير محدد' }}</td>
                        <td>
                            @if($bill->BillStatus == 1)
                                <span class="badge badge-success">نشط</span>
                            @else
                                <span class="badge badge-warning">معلق</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.bills.show', $bill->ID) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.bills.edit', $bill->ID) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">لا توجد فواتير</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($bills->hasPages())
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted">
                عرض {{ $bills->firstItem() }} إلى {{ $bills->lastItem() }} من أصل {{ $bills->total() }} فاتورة
            </div>
            <div>
                {{ $bills->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
