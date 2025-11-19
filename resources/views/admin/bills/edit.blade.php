@extends('layouts.admin')

@section('title', 'تعديل الفاتورة')
@section('page-title', 'تعديل الفاتورة')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="bi bi-pencil ms-2"></i> تعديل بيانات الفاتورة #{{ $bill->ID }}
    </div>
    <div class="card-body">
        <form action="{{ route('admin.bills.update', $bill->ID) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">رقم الفاتورة</label>
                    <input type="text" value="{{ $bill->ID }}" class="form-control" disabled>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">الطالب</label>
                    <select name="CustomerCode" class="form-select" required>
                        @foreach($customers as $c)
                            <option value="{{ $c->Code }}" {{ old('CustomerCode', $bill->CustomerCode) == $c->Code ? 'selected' : '' }}>
                                {{ $c->Code }} - {{ $c->Name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">الخدمة</label>
                    <select name="ServiceType_ID" class="form-select" required>
                        @foreach($services as $s)
                            <option value="{{ $s->ID }}" {{ old('ServiceType_ID', $bill->ServiceType_ID) == $s->ID ? 'selected' : '' }}>
                                {{ $s->SERVICESName }} - {{ number_format($s->value, 2) }} ج.م
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">تاريخ الاستحقاق</label>
                    <input type="date" name="DueDate" value="{{ old('DueDate', optional($bill->DueDate)->format('Y-m-d')) }}" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">الحالة</label>
                    <select name="BillStatus" class="form-select" required>
                        <option value="1" {{ old('BillStatus', $bill->BillStatus) == 1 ? 'selected' : '' }}>معلق</option>
                        <option value="2" {{ old('BillStatus', $bill->BillStatus) == 2 ? 'selected' : '' }}>مدفوع</option>
                        <option value="3" {{ old('BillStatus', $bill->BillStatus) == 3 ? 'selected' : '' }}>ملغي</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">تاريخ السداد (اختياري)</label>
                    <input type="date" name="SettlementDate" value="{{ old('SettlementDate', optional($bill->SettlementDate)->format('Y-m-d')) }}" class="form-control">
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.bills.index') }}" class="btn btn-outline-secondary ms-2">إلغاء</a>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </div>
        </form>
    </div>
    @if ($errors->any())
    <div class="card-footer">
        <div class="alert alert-danger mb-0">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
@endsection
