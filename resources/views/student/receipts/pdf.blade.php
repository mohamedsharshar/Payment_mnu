<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير الإيصالات</title>
    <style>
        @page {
            margin: 20mm;
        }

        * {
            font-family: 'DejaVu Sans', sans-serif;
        }

        body {
            direction: rtl;
            text-align: right;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #2c3e50;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 24px;
            margin: 0 0 10px 0;
        }

        .header p {
            color: #7f8c8d;
            margin: 5px 0;
            font-size: 11px;
        }

        .info-section {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .info-section h3 {
            color: #2c3e50;
            font-size: 14px;
            margin: 0 0 10px 0;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .info-label {
            display: table-cell;
            width: 30%;
            font-weight: bold;
            color: #555;
        }

        .info-value {
            display: table-cell;
            width: 70%;
            color: #333;
        }

        .stats-container {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .stat-box {
            display: table-cell;
            width: 25%;
            background: #ecf0f1;
            padding: 12px;
            text-align: center;
            border: 1px solid #bdc3c7;
        }

        .stat-box:not(:last-child) {
            border-left: none;
        }

        .stat-label {
            font-size: 10px;
            color: #7f8c8d;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table thead {
            background: #34495e;
            color: white;
        }

        table th {
            padding: 10px;
            text-align: center;
            font-size: 11px;
            font-weight: bold;
        }

        table td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 10px;
        }

        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        table tbody tr:hover {
            background: #e8f4f8;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-pending {
            background: #f39c12;
            color: white;
        }

        .badge-paid {
            background: #27ae60;
            color: white;
        }

        .badge-cancelled {
            background: #e74c3c;
            color: white;
        }

        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 2px solid #ecf0f1;
            text-align: center;
            font-size: 10px;
            color: #7f8c8d;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #95a5a6;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>تقرير الإيصالات</h1>
        <p>تاريخ التقرير: {{ date('Y-m-d H:i') }}</p>
    </div>

    <div class="info-section">
        <h3>معلومات الطالب</h3>
        <div class="info-row">
            <div class="info-label">كود الطالب:</div>
            <div class="info-value">{{ $customer->Code }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">الاسم:</div>
            <div class="info-value">{{ $customer->Name }}</div>
        </div>
        @if($customer->faculty)
        <div class="info-row">
            <div class="info-label">الكلية:</div>
            <div class="info-value">{{ $customer->faculty->NameAR }}</div>
        </div>
        @endif
        @if($customer->Email)
        <div class="info-row">
            <div class="info-label">البريد الإلكتروني:</div>
            <div class="info-value">{{ $customer->Email }}</div>
        </div>
        @endif
    </div>

    <div class="stats-container">
        <div class="stat-box">
            <div class="stat-label">إجمالي الإيصالات</div>
            <div class="stat-value">{{ $stats['total'] }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">مدفوع</div>
            <div class="stat-value" style="color: #27ae60;">{{ $stats['paid'] }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">معلق</div>
            <div class="stat-value" style="color: #f39c12;">{{ $stats['pending'] }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">ملغي</div>
            <div class="stat-value" style="color: #e74c3c;">{{ $stats['cancelled'] }}</div>
        </div>
    </div>

    @if($receipts->count() > 0)
    <table>
        <thead>
            <tr>
                <th>رقم الإيصال</th>
                <th>نوع الخدمة</th>
                <th>القيمة</th>
                <th>الحالة</th>
                <th>تاريخ الإنشاء</th>
                <th>تاريخ الاستحقاق</th>
                <th>تاريخ الدفع</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receipts as $receipt)
            <tr>
                <td><strong>#{{ $receipt->ID }}</strong></td>
                <td>{{ $receipt->service ? $receipt->service->SERVICESName : 'غير محدد' }}</td>
                <td>{{ $receipt->service ? number_format($receipt->service->value, 2) : '-' }} جنيه</td>
                <td>
                    @if($receipt->BillStatus == 1)
                        <span class="badge badge-pending">معلق</span>
                    @elseif($receipt->BillStatus == 2)
                        <span class="badge badge-paid">مدفوع</span>
                    @else
                        <span class="badge badge-cancelled">ملغي</span>
                    @endif
                </td>
                <td>{{ $receipt->created_at ? $receipt->created_at->format('Y-m-d') : '-' }}</td>
                <td>{{ $receipt->DueDate ? date('Y-m-d', strtotime($receipt->DueDate)) : '-' }}</td>
                <td>{{ $receipt->SettlementDate ? $receipt->SettlementDate : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px; padding: 10px; background: #ecf0f1; border-radius: 5px;">
        <strong>إجمالي القيمة المالية:</strong> {{ number_format($stats['total_amount'], 2) }} جنيه
    </div>
    @else
    <div class="no-data">
        <p style="font-size: 14px;">لا توجد إيصالات متاحة</p>
    </div>
    @endif

    <div class="footer">
        <p>تم إنشاء هذا التقرير تلقائياً بواسطة نظام إدارة المدفوعات</p>
        <p>جميع الحقوق محفوظة © {{ date('Y') }}</p>
    </div>
</body>
</html>
