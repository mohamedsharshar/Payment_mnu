@extends('layouts.admin')

@section('title', 'تعديل بيانات الطالب')
@section('page-title', 'تعديل بيانات الطالب')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="bi bi-pencil ms-2"></i> تعديل بيانات الطالب
    </div>
    <div class="card-body">
        <form action="{{ route('admin.customers.update', $customer->Code) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">كود الطالب</label>
                    <input type="text" value="{{ $customer->Code }}" class="form-control" disabled>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="Name" value="{{ old('Name', $customer->Name) }}" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="Email" value="{{ old('Email', $customer->Email) }}" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">الجوال</label>
                    <input type="text" name="Mobile" value="{{ old('Mobile', $customer->Mobile) }}" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">الوصف</label>
                    <textarea name="Description" class="form-control" rows="3">{{ old('Description', $customer->Description) }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary ms-2">إلغاء</a>
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
