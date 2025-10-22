<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\EfPayment;
use App\Models\Service;
use App\Models\Faculty;
use App\Models\UserLevel;
use App\Exports\CustomersExport;
use App\Exports\BillsExport;
use App\Exports\PaymentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reportType = $request->input('report_type', 'customers');

        // Statistics
        $totalCustomers = Customer::count();
        $totalBills = Bill::count();
        $totalPayments = EfPayment::count();
        $totalAmount = EfPayment::sum('Amount');

        // Initialize variables
        $customers = Customer::with(['faculty', 'userLevel'])->paginate(15);
        $bills = Bill::with(['customer', 'service'])->paginate(15);
        $payments = EfPayment::with(['billAmount.bill.customer', 'billAmount.bill.service'])->paginate(15);

        // Get data based on report type and filters
        if ($reportType == 'customers') {
            $query = Customer::with(['faculty', 'userLevel']);

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('Name', 'like', "%{$search}%")
                      ->orWhere('Code', 'like', "%{$search}%")
                      ->orWhere('Mobile', 'like', "%{$search}%");
                });
            }

            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }

            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            $customers = $query->paginate(15);
        }
        elseif ($reportType == 'bills') {
            $query = Bill::with(['customer', 'service']);

            if ($request->filled('search')) {
                $search = $request->search;
                $query->whereHas('customer', function($q) use ($search) {
                    $q->where('Name', 'like', "%{$search}%");
                });
            }

            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }

            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            $bills = $query->paginate(15);
        }
        elseif ($reportType == 'payments') {
            $query = EfPayment::with(['billAmount.bill.customer', 'billAmount.bill.service']);

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('Transaction_Number', 'like', "%{$search}%")
                      ->orWhereHas('billAmount.bill.customer', function($q) use ($search) {
                          $q->where('Name', 'like', "%{$search}%");
                      });
                });
            }

            if ($request->filled('date_from')) {
                $query->whereDate('Payment_Date', '>=', $request->date_from);
            }

            if ($request->filled('date_to')) {
                $query->whereDate('Payment_Date', '<=', $request->date_to);
            }

            $payments = $query->paginate(15);
        }

        return view('admin.reports.index', compact(
            'totalCustomers',
            'totalBills',
            'totalPayments',
            'totalAmount',
            'customers',
            'bills',
            'payments'
        ));
    }

    public function export(Request $request)
    {
        $reportType = $request->input('report_type', 'customers');
        $format = $request->input('export', 'excel');

        $filters = [
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'search' => $request->search,
            'service_id' => $request->service_id,
            'status' => $request->status,
            'faculty_id' => $request->faculty_id,
            'user_level_id' => $request->user_level_id,
        ];

        $fileName = $reportType . '_report_' . date('Y-m-d_H-i-s');

        switch ($reportType) {
            case 'customers':
                return $this->exportCustomers($format, $filters, $fileName);
            case 'bills':
                return $this->exportBills($format, $filters, $fileName);
            case 'payments':
                return $this->exportPayments($format, $filters, $fileName);
            default:
                return back()->with('error', 'نوع التقرير غير صحيح');
        }
    }

    private function exportCustomers($format, $filters, $fileName)
    {
        if ($format == 'pdf') {
            $customers = (new CustomersExport($filters))->collection();
            $html = view('admin.reports.pdf.customers', compact('customers'))->render();

            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4-L',
                'margin_left' => 15,
                'margin_right' => 15,
                'margin_top' => 15,
                'margin_bottom' => 15,
                'margin_header' => 0,
                'margin_footer' => 0,
                'default_font' => 'dejavusans'
            ]);

            $mpdf->SetDirectionality('rtl');
            $mpdf->WriteHTML($html);
            return $mpdf->Output($fileName . '.pdf', 'D');
        }
        elseif ($format == 'csv') {
            return Excel::download(new CustomersExport($filters), $fileName . '.csv', \Maatwebsite\Excel\Excel::CSV);
        }
        else {
            return Excel::download(new CustomersExport($filters), $fileName . '.xlsx');
        }
    }

    private function exportBills($format, $filters, $fileName)
    {
        if ($format == 'pdf') {
            $bills = (new BillsExport($filters))->collection();
            $html = view('admin.reports.pdf.bills', compact('bills'))->render();

            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4-L',
                'margin_left' => 15,
                'margin_right' => 15,
                'margin_top' => 15,
                'margin_bottom' => 15,
                'margin_header' => 0,
                'margin_footer' => 0,
                'default_font' => 'dejavusans'
            ]);

            $mpdf->SetDirectionality('rtl');
            $mpdf->WriteHTML($html);
            return $mpdf->Output($fileName . '.pdf', 'D');
        }
        elseif ($format == 'csv') {
            return Excel::download(new BillsExport($filters), $fileName . '.csv', \Maatwebsite\Excel\Excel::CSV);
        }
        else {
            return Excel::download(new BillsExport($filters), $fileName . '.xlsx');
        }
    }

    private function exportPayments($format, $filters, $fileName)
    {
        if ($format == 'pdf') {
            $payments = (new PaymentsExport($filters))->collection();
            $html = view('admin.reports.pdf.payments', compact('payments'))->render();

            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4-L',
                'margin_left' => 15,
                'margin_right' => 15,
                'margin_top' => 15,
                'margin_bottom' => 15,
                'margin_header' => 0,
                'margin_footer' => 0,
                'default_font' => 'dejavusans'
            ]);

            $mpdf->SetDirectionality('rtl');
            $mpdf->WriteHTML($html);
            return $mpdf->Output($fileName . '.pdf', 'D');
        }
        elseif ($format == 'csv') {
            return Excel::download(new PaymentsExport($filters), $fileName . '.csv', \Maatwebsite\Excel\Excel::CSV);
        }
        else {
            return Excel::download(new PaymentsExport($filters), $fileName . '.xlsx');
        }
    }
}
