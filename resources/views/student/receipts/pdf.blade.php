<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تقرير الإيصالات</title>
    <style>
        body {
            font-family: 'DejaVuSans', sans-serif;
            direction: rtl;
            text-align: right;
            font-size: 11px;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #000;
        }

        .header h1 {
            font-size: 18px;
            margin: 5px 0;
        }

        .header p {
            margin: 3px 0;
            font-size: 10px;
        }

        .info-box {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #000;
        }

        .info-box h3 {
            font-size: 13px;
            margin: 0 0 10px 0;
            text-decoration: underline;
        }

        .info-row {
            margin-bottom: 5px;
            line-height: 1.6;
        }

        .label {
            font-weight: bold;
        }

        .stats {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #000;
            text-align: center;
        }

        .stat-item {
            display: inline-block;
            width: 22%;
            margin: 5px;
            vertical-align: top;
        }

        .stat-label {
            font-size: 9px;
            display: block;
            margin-bottom: 3px;
        }

        .stat-value {
            font-size: 14px;
            font-weight: bold;
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 4px;
            text-align: center;
            font-size: 9px;
        }

        th {
            font-weight: bold;
            background-color: #e0e0e0;
        }

        .total {
            margin-top: 15px;
            padding: 10px;
            border: 1px solid #000;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #000;
            text-align: center;
            font-size: 9px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>تقرير الإيصالات</h1>
        <p>تاريخ التقرير: {{ date('Y-m-d H:i') }}</p>
    </div>

    <div class="info-box">
        <h3>معلومات الطالب</h3>
        <div class="info-row">
            <span class="label">كود الطالب:</span> {{ $customer->Code }}
        </div>
        <div class="info-row">
            <span class="label">الاسم:</span> {{ $customer->Name }}
        </div>
        @if($customer->faculty)
        <div class="info-row">
            <span class="label">الكلية:</span> {{ $customer->faculty->NameAR }}
        </div>
        @endif
        @if($customer->Email)
        <div class="info-row">
            <span class="label">البريد الإلكتروني:</span> {{ $customer->Email }}
        </div>
        @endif
    </div>

    <div class="stats">
        <div class="stat-item">
            <span class="stat-label">إجمالي الإيصالات</span>
            <span class="stat-value">{{ $stats['total'] }}</span>
        </div>
        <div class="stat-item">
            <span class="stat-label">مدفوع</span>
            <span class="stat-value">{{ $stats['paid'] }}</span>
        </div>
        <div class="stat-item">
            <span class="stat-label">معلق</span>
            <span class="stat-value">{{ $stats['pending'] }}</span>
        </div>
        <div class="stat-item">
            <span class="stat-label">ملغي</span>
            <span class="stat-value">{{ $stats['cancelled'] }}</span>
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
                <td>{{ $receipt->ID }}</td>
                <td>{{ $receipt->service ? $receipt->service->SERVICESName : 'غير محدد' }}</td>
                <td>{{ $receipt->service ? number_format($receipt->service->value, 2) : '-' }}</td>
                <td>
                    @if($receipt->BillStatus == 1)
                        معلق
                    @elseif($receipt->BillStatus == 2)
                        مدفوع
                    @else
                        ملغي
                    @endif
                </td>
                <td>{{ $receipt->created_at ? $receipt->created_at->format('Y-m-d') : '-' }}</td>
                <td>{{ $receipt->DueDate ? date('Y-m-d', strtotime($receipt->DueDate)) : '-' }}</td>
                <td>{{ $receipt->SettlementDate ? $receipt->SettlementDate : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        إجمالي القيمة المالية: {{ number_format($stats['total_amount'], 2) }} جنيه
    </div>
    @else
    <div style="text-align: center; padding: 30px;">
        لا توجد إيصالات متاحة
    </div>
    @endif

    <div class="footer">
        <p>تم إنشاء هذا التقرير تلقائياً بواسطة نظام إدارة المدفوعات</p>
        <p>جميع الحقوق محفوظة © {{ date('Y') }}</p>
    </div>
</body>
</html>
