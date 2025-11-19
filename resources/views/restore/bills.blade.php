@extends('layouts.admin')

@section('title', 'سلة المحذوفات - الفواتير')
@section('page-title', 'سلة المحذوفات - الفواتير')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-trash ms-2"></i> الفواتير المحذوفة</span>
        <a href="{{ route('admin.bills.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-right ms-2"></i> العودة للفواتير
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
                        <th>رقم الفاتورة</th>
                        <th>الطالب</th>
                        <th>الخدمة</th>
                        <th>حالة الفاتورة</th>
                        <th>تاريخ الحذف</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bills as $bill)
                    <tr>
                        <td><strong>#{{ $bill->ID }}</strong></td>
                        <td>{{ $bill->customer->Name ?? 'غير محدد' }}</td>
                        <td>{{ $bill->service->SERVICESName ?? 'غير محدد' }}</td>
                        <td>
                            @if($bill->BillStatus == 1)
                                <span class="badge bg-warning">قيد الانتظار</span>
                            @elseif($bill->BillStatus == 2)
                                <span class="badge bg-success">مدفوعة</span>
                            @else
                                <span class="badge bg-danger">ملغاة</span>
                            @endif
                        </td>
                        <td>{{ $bill->deleted_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.restore.bills.restore', $bill->ID) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('هل تريد استرجاع هذه الفاتورة؟');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success me-1">
                                    <i class="bi bi-arrow-counterclockwise"></i> استرجاع
                                </button>
                            </form>
                            <form action="{{ route('admin.restore.bills.force-delete', $bill->ID) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('هل أنت متأكد من الحذف النهائي؟ لن يمكن استرجاع البيانات!');">
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
                                <p class="mt-2">لا توجد فواتير محذوفة</p>
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
