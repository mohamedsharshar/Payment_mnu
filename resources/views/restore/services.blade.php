@extends('layouts.admin')

@section('title', 'سلة المحذوفات - الخدمات')
@section('page-title', 'سلة المحذوفات - الخدمات')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-trash ms-2"></i> الخدمات المحذوفة</span>
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-right ms-2"></i> العودة للخدمات
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
                        <th>رقم الخدمة</th>
                        <th>اسم الخدمة</th>
                        <th>القيمة</th>
                        <th>تاريخ الحذف</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td><strong>#{{ $service->ID }}</strong></td>
                        <td>{{ $service->SERVICESName }}</td>
                        <td>{{ number_format($service->value, 2) }} جنيه</td>
                        <td>{{ $service->deleted_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.restore.services.restore', $service->ID) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('هل تريد استرجاع هذه الخدمة؟');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success me-1">
                                    <i class="bi bi-arrow-counterclockwise"></i> استرجاع
                                </button>
                            </form>
                            <form action="{{ route('admin.restore.services.force-delete', $service->ID) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('هل أنت متأكد من الحذف النهائي؟ لن يمكن استرجاع البيانات!');">
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
                        <td colspan="5" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                <p class="mt-2">لا توجد خدمات محذوفة</p>
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
