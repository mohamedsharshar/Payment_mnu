<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentReceiptsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $receipts;
    protected $customer;

    public function __construct($receipts, $customer)
    {
        $this->receipts = $receipts;
        $this->customer = $customer;
    }

    public function collection()
    {
        return $this->receipts;
    }

    public function headings(): array
    {
        return [
            'رقم الإيصال',
            'نوع الخدمة',
            'حالة الإيصال',
            'تاريخ الإنشاء',
            'تاريخ الاستحقاق',
            'تاريخ الدفع',
        ];
    }

    public function map($receipt): array
    {
        $statusMap = [
            1 => 'معلق',
            2 => 'مدفوع',
            3 => 'ملغي',
        ];

        return [
            $receipt->ID,
            $receipt->service ? $receipt->service->Name : 'غير محدد',
            $statusMap[$receipt->BillStatus] ?? 'غير معروف',
            $receipt->created_at ? $receipt->created_at->format('Y-m-d') : '',
            $receipt->DueDate ? date('Y-m-d', strtotime($receipt->DueDate)) : '',
            $receipt->SettlementDate ?? '',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
        return 'إيصالات الطالب';
    }
}
