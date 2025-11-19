@extends('layouts.admin')

@section('title', 'إضافة طالب')
@section('page-title', 'إضافة طالب جديد')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="bi bi-plus-circle ms-2"></i> بيانات الطالب
    </div>
    <div class="card-body">
        <form action="{{ route('admin.customers.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">كود الطالب (الرقم القومي)</label>
                    <input type="text" name="Code" value="{{ old('Code') }}" class="form-control" maxlength="14" required>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="Name" value="{{ old('Name') }}" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="Email" value="{{ old('Email') }}" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">الجوال</label>
                    <input type="text" name="Mobile" value="{{ old('Mobile') }}" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">الوصف</label>
                    <textarea name="Description" class="form-control" rows="3">{{ old('Description') }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary ms-2">إلغاء</a>
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
