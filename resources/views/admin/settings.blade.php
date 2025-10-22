@extends('layouts.admin')

@section('title', 'الإعدادات')
@section('page-title', 'الإعدادات')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-circle ms-2"></i> معلومات الحساب
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">الاسم</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name ?? 'المسؤول' }}" style="border-radius: 10px; border: 2px solid var(--light-blue);">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" value="{{ Auth::user()->email ?? 'admin@example.com' }}" style="border-radius: 10px; border: 2px solid var(--light-blue);">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save ms-2"></i> حفظ التغييرات
                    </button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <i class="bi bi-shield-lock ms-2"></i> تغيير كلمة المرور
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">كلمة المرور الحالية</label>
                        <input type="password" class="form-control" style="border-radius: 10px; border: 2px solid var(--light-blue);">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">كلمة المرور الجديدة</label>
                        <input type="password" class="form-control" style="border-radius: 10px; border: 2px solid var(--light-blue);">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" class="form-control" style="border-radius: 10px; border: 2px solid var(--light-blue);">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-key ms-2"></i> تحديث كلمة المرور
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-gear ms-2"></i> إعدادات النظام
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="p-4" style="background: linear-gradient(135deg, rgba(84, 9, 218, 0.1), rgba(78, 113, 255, 0.1)); border-radius: 15px;">
                            <h5 class="mb-3"><i class="bi bi-building ms-2"></i> معلومات الجامعة</h5>
                            <div class="mb-3">
                                <label class="form-label">اسم الجامعة</label>
                                <input type="text" class="form-control" value="جامعة المنصورة" style="border-radius: 10px;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">العنوان</label>
                                <input type="text" class="form-control" value="المنصورة، مصر" style="border-radius: 10px;">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="p-4" style="background: linear-gradient(135deg, rgba(78, 113, 255, 0.1), rgba(141, 216, 255, 0.1)); border-radius: 15px;">
                            <h5 class="mb-3"><i class="bi bi-envelope ms-2"></i> إعدادات البريد</h5>
                            <div class="mb-3">
                                <label class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control" value="info@university.edu" style="border-radius: 10px;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">الهاتف</label>
                                <input type="tel" class="form-control" value="+20 50 1234567" style="border-radius: 10px;">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="p-4" style="background: linear-gradient(135deg, rgba(141, 216, 255, 0.1), rgba(187, 251, 255, 0.1)); border-radius: 15px;">
                            <h5 class="mb-3"><i class="bi bi-credit-card ms-2"></i> إعدادات الدفع</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">طرق الدفع المتاحة</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">بطاقات الائتمان</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">المحفظة الإلكترونية</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked>
                                        <label class="form-check-label">التحويل البنكي</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">العملة الافتراضية</label>
                                    <select class="form-select" style="border-radius: 10px;">
                                        <option>جنيه مصري (EGP)</option>
                                        <option>دولار أمريكي (USD)</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">مدة استحقاق الفاتورة</label>
                                    <select class="form-select" style="border-radius: 10px;">
                                        <option>7 أيام</option>
                                        <option>14 يوم</option>
                                        <option>30 يوم</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button class="btn btn-primary btn-lg">
                        <i class="bi bi-save ms-2"></i> حفظ جميع الإعدادات
                    </button>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <i class="bi bi-info-circle ms-2"></i> معلومات النظام
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-3">
                        <div class="p-3" style="background: linear-gradient(135deg, var(--primary-dark), var(--primary-blue)); border-radius: 15px; color: white;">
                            <h6>إصدار Laravel</h6>
                            <h4>{{ app()->version() }}</h4>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-3">
                        <div class="p-3" style="background: linear-gradient(135deg, var(--primary-blue), var(--light-blue)); border-radius: 15px; color: white;">
                            <h6>إصدار PHP</h6>
                            <h4>{{ PHP_VERSION }}</h4>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-3">
                        <div class="p-3" style="background: linear-gradient(135deg, var(--light-blue), var(--pale-blue)); border-radius: 15px; color: var(--primary-dark);">
                            <h6>قاعدة البيانات</h6>
                            <h4>MySQL</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
