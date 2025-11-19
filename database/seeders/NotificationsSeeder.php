<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Bill;
use App\Notifications\BillCreatedNotification;

class NotificationsSeeder extends Seeder
{
    public function run(): void
    {
        // البحث عن المستخدم الطالب
        $student = User::where('email', '30404291700673')->first();

        if (!$student) {
            $this->command->info('لا يوجد طالب بهذا الرقم القومي');
            return;
        }

        // الحصول على آخر 3 فواتير للطالب
        $bills = Bill::where('CustomerCode', $student->customer_code)
            ->with('service')
            ->latest()
            ->take(3)
            ->get();

        if ($bills->isEmpty()) {
            $this->command->info('لا توجد فواتير لهذا الطالب');
            return;
        }

        // إرسال إشعارات للفواتير
        foreach ($bills as $bill) {
            $student->notify(new BillCreatedNotification($bill));
        }

        $this->command->info('تم إنشاء ' . $bills->count() . ' إشعار بنجاح');
    }
}
