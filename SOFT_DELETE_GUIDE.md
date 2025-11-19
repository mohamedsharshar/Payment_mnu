# دليل استخدام خاصية Soft Delete (الحذف المؤقت)

## نظرة عامة
تم إضافة خاصية Soft Delete لجميع الجداول الرئيسية في النظام، وهي تسمح بحذف السجلات بشكل مؤقت بدلاً من الحذف النهائي، مما يتيح إمكانية استرجاعها لاحقاً.

## الجداول المتأثرة
- **Customers** (الطلاب)
- **Bills** (الفواتير)
- **Services** (الخدمات)
- **Users** (المستخدمين)

## كيفية الاستخدام

### 1. الحذف المؤقت (Soft Delete)
عند حذف أي سجل بالطريقة العادية، سيتم نقله إلى سلة المحذوفات:

```php
// حذف طالب
$customer = Customer::find('CODE123');
$customer->delete(); // سيتم وضع deleted_at فقط

// حذف فاتورة
$bill = Bill::find(1);
$bill->delete();
```

### 2. عرض السجلات المحذوفة
للوصول إلى صفحات سلة المحذوفات:
- **الطلاب المحذوفين**: `/admin/restore/customers`
- **الفواتير المحذوفة**: `/admin/restore/bills`
- **الخدمات المحذوفة**: `/admin/restore/services`
- **المستخدمين المحذوفين**: `/admin/restore/users`

### 3. استرجاع السجلات (Restore)
يمكن استرجاع أي سجل محذوف من صفحة سلة المحذوفات بالضغط على زر "استرجاع".

```php
// استرجاع طالب
$customer = Customer::onlyTrashed()->where('Code', 'CODE123')->first();
$customer->restore();

// استرجاع فاتورة
$bill = Bill::onlyTrashed()->find(1);
$bill->restore();
```

### 4. الحذف النهائي (Force Delete)
لحذف السجل بشكل نهائي من قاعدة البيانات:

```php
// حذف نهائي لطالب
$customer = Customer::onlyTrashed()->where('Code', 'CODE123')->first();
$customer->forceDelete(); // حذف نهائي - لا يمكن الاسترجاع

// حذف نهائي لفاتورة
$bill = Bill::onlyTrashed()->find(1);
$bill->forceDelete();
```

## الاستعلامات المتقدمة

### عرض السجلات النشطة فقط (افتراضي)
```php
$customers = Customer::all(); // فقط السجلات غير المحذوفة
$bills = Bill::where('BillStatus', 1)->get();
```

### عرض السجلات المحذوفة فقط
```php
$trashedCustomers = Customer::onlyTrashed()->get();
$trashedBills = Bill::onlyTrashed()->get();
```

### عرض جميع السجلات (المحذوفة وغير المحذوفة)
```php
$allCustomers = Customer::withTrashed()->get();
$allBills = Bill::withTrashed()->get();
```

### التحقق من حالة الحذف
```php
if ($customer->trashed()) {
    echo 'هذا السجل محذوف';
}
```

## Routes (المسارات)

### سلة المحذوفات
- `GET /admin/restore/customers` - عرض الطلاب المحذوفين
- `GET /admin/restore/bills` - عرض الفواتير المحذوفة
- `GET /admin/restore/services` - عرض الخدمات المحذوفة
- `GET /admin/restore/users` - عرض المستخدمين المحذوفين

### عمليات الاسترجاع
- `POST /admin/restore/customers/{code}` - استرجاع طالب
- `POST /admin/restore/bills/{id}` - استرجاع فاتورة
- `POST /admin/restore/services/{id}` - استرجاع خدمة
- `POST /admin/restore/users/{id}` - استرجاع مستخدم

### الحذف النهائي
- `DELETE /admin/restore/customers/{code}` - حذف طالب نهائياً
- `DELETE /admin/restore/bills/{id}` - حذف فاتورة نهائياً
- `DELETE /admin/restore/services/{id}` - حذف خدمة نهائياً
- `DELETE /admin/restore/users/{id}` - حذف مستخدم نهائياً

## ملاحظات مهمة

1. **التلقائية**: عند استخدام `delete()` على أي Model يحتوي على `SoftDeletes`، سيتم الحذف المؤقت تلقائياً.

2. **العلاقات**: عند حذف سجل يحتوي على علاقات (مثل طالب له فواتير)، تأكد من معالجة العلاقات بشكل صحيح.

3. **البحث والفلترة**: جميع الاستعلامات الافتراضية تتجاهل السجلات المحذوفة تلقائياً.

4. **الأمان**: الحذف النهائي يحتاج صلاحيات خاصة ويجب استخدامه بحذر.

## الوصول من القائمة الجانبية
تم إضافة روابط في القائمة الجانبية للوحة التحكم للوصول السريع إلى صفحات سلة المحذوفات لكل نوع من السجلات.
