<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Bill;

class BillCreatedNotification extends Notification
{
    use Queueable;

    protected $bill;

    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('فاتورة جديدة - ' . $this->bill->service->SERVICESName)
            ->greeting('مرحباً ' . $notifiable->name)
            ->line('تم إصدار فاتورة جديدة برقم: ' . $this->bill->ID)
            ->line('نوع الخدمة: ' . $this->bill->service->SERVICESName)
            ->line('المبلغ: ' . number_format($this->bill->service->value, 2) . ' جنيه')
            ->line('تاريخ الاستحقاق: ' . $this->bill->DueDate->format('Y-m-d'))
            ->action('عرض التفاصيل', route('student.receipts.index'))
            ->line('شكراً لاستخدامك نظام الدفع الجامعي!');
    }

    public function toArray($notifiable)
    {
        return [
            'bill_id' => $this->bill->ID,
            'service_name' => $this->bill->service->SERVICESName,
            'amount' => $this->bill->service->value,
            'due_date' => $this->bill->DueDate->format('Y-m-d'),
            'message' => 'تم إصدار فاتورة جديدة برقم ' . $this->bill->ID . ' - ' . $this->bill->service->SERVICESName
        ];
    }
}
