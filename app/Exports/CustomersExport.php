<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomersExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Customer::with(['faculty', 'userLevel']);

        if (!empty($this->filters['faculty_id'])) {
            $query->where('facultyID', $this->filters['faculty_id']);
        }

        if (!empty($this->filters['user_level_id'])) {
            $query->where('UserLevelID', $this->filters['user_level_id']);
        }

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('Name', 'like', "%{$search}%")
                  ->orWhere('Code', 'like', "%{$search}%")
                  ->orWhere('Mobile', 'like', "%{$search}%");
            });
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'الكود',
            'الاسم',
            'الوصف',
            'رقم الهاتف',
            'البريد الإلكتروني',
            'الكلية',
            'المستوى',
            'تاريخ الإنشاء'
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->Code,
            $customer->Name,
            $customer->Description,
            $customer->Mobile,
            $customer->Email,
            optional($customer->faculty)->Name ?? '-',
            optional($customer->userLevel)->Name ?? '-',
            $customer->CreatedIn
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
