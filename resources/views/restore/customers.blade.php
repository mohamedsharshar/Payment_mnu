@extends('layouts.admin')

@section('title', 'سلة المحذوفات - الطلاب')
@section('page-title', 'سلة المحذوفات - الطلاب')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-trash ms-2"></i> الطلاب المحذوفين</span>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-right ms-2"></i> العودة للطلاب
        </a>
    </div>
    <div class="card-body p-0">
        @if(session('success'))
            <div class="alert alert-success m-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>كود الطالب</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الجوال</th>
                        <th>تاريخ الحذف</th>
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
                        <td>{{ $customer->deleted_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.restore.customers.restore', $customer->Code) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('هل تريد استرجاع هذا الطالب؟');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success me-1">
                                    <i class="bi bi-arrow-counterclockwise"></i> استرجاع
                                </button>
                            </form>
                            <form action="{{ route('admin.restore.customers.force-delete', $customer->Code) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('هل أنت متأكد من الحذف النهائي؟ لن يمكن استرجاع البيانات!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash-fill"></i> حذف نهائي
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                <p class="mt-2">لا توجد طلاب محذوفين</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
