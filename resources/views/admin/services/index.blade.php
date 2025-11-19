@extends('layouts.admin')

@section('title', 'إدارة الخدمات')
@section('page-title', 'إدارة الخدمات')

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="icon">
                <i class="bi bi-box-seam"></i>
            </div>
            <h6>إجمالي الخدمات</h6>
            <h3>{{ $services->count() }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="icon">
                <i class="bi bi-receipt"></i>
            </div>
            <h6>إجمالي الفواتير</h6>
            <h3>{{ $services->sum('bills_count') }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="icon">
                <i class="bi bi-cash-stack"></i>
            </div>
            <h6>إجمالي القيمة</h6>
            <h3>{{ number_format($services->sum('value'), 2) }} <small>ج.م</small></h3>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-box-seam ms-2"></i> قائمة الخدمات</span>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="bi bi-plus-circle ms-2"></i> إضافة خدمة جديدة
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الخدمة</th>
                        <th>القيمة</th>
                        <th>عدد الفواتير</th>
                        <th>إجمالي الإيرادات</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td><strong>{{ $service->ID }}</strong></td>
                        <td>
                            <strong>{{ $service->SERVICESName }}</strong>
                        </td>
                        <td>
                            <span class="badge" style="background: linear-gradient(135deg, #28a745, #20c997); font-size: 0.95rem;">
                                {{ number_format($service->value, 2) }} ج.م
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-success">{{ $service->bills_count }} فاتورة</span>
                        </td>
                        <td>
                            <strong style="color: var(--primary-dark);">
                                {{ number_format($service->value * $service->bills_count, 2) }} ج.م
                            </strong>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1" onclick="editService({{ $service->ID }}, '{{ $service->SERVICESName }}', {{ $service->value }})">
                                <i class="bi bi-pencil"></i> تعديل
                            </button>
                            <form action="{{ route('admin.services.destroy', $service->ID) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('هل أنت متأكد من حذف هذه الخدمة؟');">
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
                        <td colspan="6" class="text-center text-muted py-4">لا توجد خدمات</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-blue), var(--light-blue)); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title"><i class="bi bi-plus-circle ms-2"></i> إضافة خدمة جديدة</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">اسم الخدمة</label>
                        <input type="text" name="SERVICESName" class="form-control" required style="border-radius: 10px; border: 2px solid var(--light-blue);">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">القيمة (ج.م)</label>
                        <input type="number" name="value" step="0.01" class="form-control" required style="border-radius: 10px; border: 2px solid var(--light-blue);">
                    </div>
                </div>
                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ الخدمة</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editServiceModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-blue), var(--light-blue)); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title"><i class="bi bi-pencil ms-2"></i> تعديل الخدمة</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editServiceForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">اسم الخدمة</label>
                        <input type="text" id="edit_SERVICESName" name="SERVICESName" class="form-control" required style="border-radius: 10px; border: 2px solid var(--light-blue);">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">القيمة (ج.م)</label>
                        <input type="number" id="edit_value" name="value" step="0.01" class="form-control" required style="border-radius: 10px; border: 2px solid var(--light-blue);">
                    </div>
                </div>
                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
function editService(id, name, value) {
    document.getElementById('edit_SERVICESName').value = name;
    document.getElementById('edit_value').value = value;
    document.getElementById('editServiceForm').action = `/admin/services/${id}`;

    const modal = new bootstrap.Modal(document.getElementById('editServiceModal'));
    modal.show();
}
</script>
