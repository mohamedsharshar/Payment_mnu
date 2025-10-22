<?php

namespace App\Exports;

use App\Models\Bill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BillsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Bill::with(['customer', 'service']);

        if (!empty($this->filters['service_id'])) {
            $query->where('service_id', $this->filters['service_id']);
        }

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['date_from'])) {
            $query->whereDate('created_at', '>=', $this->filters['date_from']);
        }

        if (!empty($this->filters['date_to'])) {
            $query->whereDate('created_at', '<=', $this->filters['date_to']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'رقم الفاتورة',
            'اسم الطالب',
            'الخدمة',
            'المبلغ',
            'الحالة',
            'تاريخ الإنشاء'
        ];
    }

    public function map($bill): array
    {
        $status = [
            'pending' => 'قيد الانتظار',
            'paid' => 'مدفوع',
            'cancelled' => 'ملغي'
        ];

        return [
            $bill->id,
            $bill->customer->name ?? '-',
            $bill->service->name ?? '-',
            $bill->amount . ' جنيه',
            $status[$bill->status] ?? $bill->status,
            $bill->created_at->format('Y-m-d H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
