@extends('layouts.admin')

@section('title', 'إدارة الطلاب')
@section('page-title', 'إدارة الطلاب')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-people-fill ms-2"></i> قائمة الطلاب</span>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle ms-2"></i> إضافة طالب جديد
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>كود الطالب</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الجوال</th>
                        <th>عدد الفواتير</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td><strong>{{ $customer->Code }}</strong></td>
                        <td>{{ $customer->Name }}</td>
                        <td>{{ $customer->Email ?? 'غير محدد' }}</td>
                        <td>{{ $customer->Mobile ?? 'غير محدد' }}</td>
                        <td><span class="badge badge-success">{{ $customer->bills_count }}</span></td>
                        <td>
                            <a href="{{ route('admin.customers.show', $customer->Code) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.customers.edit', $customer->Code) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.customers.destroy', $customer->Code) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('هل أنت متأكد من حذف هذا الطالب؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">لا يوجد طلاب</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($customers->hasPages())
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted">
                عرض {{ $customers->firstItem() }} إلى {{ $customers->lastItem() }} من أصل {{ $customers->total() }} طالب
            </div>
            <div>
                {{ $customers->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
