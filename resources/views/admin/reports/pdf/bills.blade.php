<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تقرير الفواتير</title>
    <style>
        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #4E71FF;
        }

        .header h1 {
            color: #4E71FF;
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: bold;
        }

        .header p {
            color: #666;
            margin: 5px 0;
            font-size: 14px;
        }

        .summary {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
            border: 1px solid #ddd;
        }

        .summary-item {
            display: inline-block;
            margin-left: 30px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }

        th {
            background-color: #fff;
            color: #333;
            padding: 12px 8px;
            text-align: right;
            font-weight: bold;
            border: 1px solid #ddd;
        }

        td {
            padding: 10px 8px;
            text-align: right;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        tr:nth-child(even) td {
            background-color: #f8f9fa;
        }

        .status {
            padding: 4px 10px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }

        .status-paid {
            background-color: #e8e8e8;
            color: #333;
            border: 1px solid #999;
        }

        .status-pending {
            background-color: #f5f5f5;
            color: #666;
            border: 1px solid #ccc;
        }

        .status-cancelled {
            background-color: #e8e8e8;
            color: #333;
            border: 1px solid #999;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 11px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>تقرير الفواتير</h1>
        <p>نظام الدفع الجامعي</p>
        <p>تاريخ التقرير: {{ date('Y-m-d H:i') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <strong>إجمالي الفواتير:</strong> {{ $bills->count() }}
        </div>
        <div class="summary-item">
            <strong>إجمالي المبلغ:</strong> {{ number_format($bills->sum('amount'), 2) }} جنيه
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">رقم الفاتورة</th>
                <th style="width: 25%;">اسم الطالب</th>
                <th style="width: 20%;">الخدمة</th>
                <th style="width: 15%;">المبلغ</th>
                <th style="width: 15%;">الحالة</th>
                <th style="width: 15%;">التاريخ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bills as $bill)
                <tr>
                    <td>{{ $bill->id }}</td>
                    <td>{{ $bill->customer->name ?? '-' }}</td>
                    <td>{{ $bill->service->name ?? '-' }}</td>
                    <td>{{ number_format($bill->amount, 2) }} جنيه</td>
                    <td>
                        @if($bill->status == 'paid')
                            <span class="status status-paid">مدفوع</span>
                        @elseif($bill->status == 'pending')
                            <span class="status status-pending">قيد الانتظار</span>
                        @else
                            <span class="status status-cancelled">ملغي</span>
                        @endif
                    </td>
                    <td>{{ $bill->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>تم إنشاء هذا التقرير بواسطة نظام الدفع الجامعي</p>
        <p>{{ date('Y') }} © جميع الحقوق محفوظة</p>
    </div>
</body>
</html>
