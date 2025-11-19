@extends('layouts.admin')

@section('title', 'إنشاء فاتورة')
@section('page-title', 'إنشاء فاتورة جديدة')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="bi bi-receipt ms-2"></i> بيانات الفاتورة
    </div>
    <div class="card-body">
        <form action="{{ route('admin.bills.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">الطالب</label>
                    <select name="CustomerCode" class="form-select" required>
                        <option value="">اختر الطالب</option>
                        @foreach($customers as $c)
                            <option value="{{ $c->Code }}" {{ old('CustomerCode') == $c->Code ? 'selected' : '' }}>
                                {{ $c->Code }} - {{ $c->Name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">الخدمة</label>
                    <select name="ServiceType_ID" class="form-select" required>
                        <option value="">اختر الخدمة</option>
                        @foreach($services as $s)
                            <option value="{{ $s->ID }}" {{ old('ServiceType_ID') == $s->ID ? 'selected' : '' }}>
                                {{ $s->SERVICESName }} - {{ number_format($s->value, 2) }} ج.م
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">تاريخ الاستحقاق</label>
                    <input type="date" name="DueDate" value="{{ old('DueDate') }}" class="form-control" required>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.bills.index') }}" class="btn btn-outline-secondary ms-2">إلغاء</a>
                <button type="submit" class="btn btn-primary">حفظ</button>
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
