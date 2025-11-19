<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;

class FacultyController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $customer = $user->customer()->with('faculty')->first();

        if (!$customer) {
            return redirect()->route('student.dashboard')->with('error', 'لا يوجد بيانات طالب مرتبطة بحسابك');
        }

        $faculty = $customer->faculty;

        // جلب إيصالات الطالب مع الفلترة
        $query = $customer->bills()->with('service');

        // البحث بالتاريخ من
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        // البحث بالتاريخ إلى
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // البحث بنوع الخدمة
        if ($request->filled('service_type')) {
            $query->where('ServiceType_ID', $request->service_type);
        }

        $receipts = $query->orderBy('created_at', 'desc')->paginate(10);

        // جلب أنواع الخدمات المستخدمة
        $serviceIds = $customer->bills()->distinct()->pluck('ServiceType_ID');
        $services = \App\Models\Service::whereIn('ID', $serviceIds)->get();

        return view('student.faculty', compact('customer', 'faculty', 'receipts', 'services'));
    }

    public function exportPdf(Request $request)
    {
        $user = Auth::user();
        $customer = $user->customer;

        if (!$customer) {
            return redirect()->route('student.dashboard')->with('error', 'لا يوجد بيانات طالب مرتبطة بحسابك');
        }

        $faculty = $customer->faculty;
        $query = $customer->bills()->with('service');

        // تطبيق نفس فلاتر البحث
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('service_type')) {
            $query->where('ServiceType_ID', $request->service_type);
        }

        $receipts = $query->orderBy('created_at', 'desc')->get();

        // حساب الإحصائيات
        $stats = [
            'total' => $receipts->count(),
            'paid' => $receipts->where('BillStatus', 2)->count(),
            'pending' => $receipts->where('BillStatus', 1)->count(),
            'cancelled' => $receipts->where('BillStatus', 3)->count(),
            'total_amount' => $receipts->sum(function($bill) {
                return $bill->service ? $bill->service->value : 0;
            })
        ];

        // إنشاء HTML
        $html = view('student.receipts.pdf', compact('receipts', 'customer', 'stats'))->render();

        // إعداد mPDF
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 15,
            'margin_bottom' => 15,
            'margin_header' => 0,
            'margin_footer' => 0,
            'default_font' => 'DejaVuSans'
        ]);

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->SetDirectionality('rtl');

        $mpdf->WriteHTML($html);

        $fileName = 'faculty_receipts_' . $customer->Code . '_' . date('Y-m-d') . '.pdf';

        return response()->streamDownload(function() use ($mpdf) {
            echo $mpdf->Output('', 'S');
        }, $fileName);
    }
}
