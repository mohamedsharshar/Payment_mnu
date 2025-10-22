<?php

namespace App\Exports;

use App\Models\EfPayment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PaymentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = EfPayment::with(['billAmount.bill.customer', 'billAmount.bill.service']);

        if (!empty($this->filters['date_from'])) {
            $query->whereDate('created_at', '>=', $this->filters['date_from']);
        }

        if (!empty($this->filters['date_to'])) {
            $query->whereDate('created_at', '<=', $this->filters['date_to']);
        }

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('transaction_id', 'like', "%{$search}%")
                  ->orWhereHas('billAmount.bill.customer', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'رقم العملية',
            'رقم المعاملة',
            'اسم الطالب',
            'الخدمة',
            'المبلغ',
            'تاريخ الدفع'
        ];
    }

    public function map($payment): array
    {
        return [
            $payment->id,
            $payment->transaction_id,
            $payment->billAmount->bill->customer->name ?? '-',
            $payment->billAmount->bill->service->name ?? '-',
            $payment->amount . ' جنيه',
            $payment->created_at->format('Y-m-d H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
