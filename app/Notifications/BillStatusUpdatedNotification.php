<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Bill;

class BillStatusUpdatedNotification extends Notification
{
    use Queueable;

    protected $bill;
    protected $oldStatus;
    protected $newStatus;

    public function __construct(Bill $bill, $oldStatus, $newStatus)
    {
        $this->bill = $bill;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $statusText = [
            1 => 'معلق',
            2 => 'مدفوع',
            3 => 'ملغي'
        ];

        return [
            'bill_id' => $this->bill->ID,
            'service_name' => $this->bill->service->SERVICESName,
            'amount' => $this->bill->service->value,
            'old_status' => $statusText[$this->oldStatus] ?? 'غير محدد',
            'new_status' => $statusText[$this->newStatus] ?? 'غير محدد',
            'message' => 'تم تحديث حالة الفاتورة رقم ' . $this->bill->ID . ' إلى: ' . ($statusText[$this->newStatus] ?? 'غير محدد')
        ];
    }
}
