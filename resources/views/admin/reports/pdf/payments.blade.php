<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تقرير المدفوعات</title>
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
            font-size: 11px;
        }

        th {
            background-color: #fff;
            color: #333;
            padding: 12px 6px;
            text-align: right;
            font-weight: bold;
            border: 1px solid #ddd;
        }

        td {
            padding: 10px 6px;
            text-align: right;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        tr:nth-child(even) td {
            background-color: #f8f9fa;
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
        <h1>تقرير المدفوعات</h1>
        <p>نظام الدفع الجامعي</p>
        <p>تاريخ التقرير: {{ date('Y-m-d H:i') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <strong>إجمالي المدفوعات:</strong> {{ $payments->count() }}
        </div>
        <div class="summary-item">
            <strong>إجمالي المبلغ:</strong> {{ number_format($payments->sum('amount'), 2) }} جنيه
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 8%;">رقم العملية</th>
                <th style="width: 17%;">رقم المعاملة</th>
                <th style="width: 22%;">اسم الطالب</th>
                <th style="width: 18%;">الخدمة</th>
                <th style="width: 15%;">المبلغ</th>
                <th style="width: 20%;">تاريخ الدفع</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->transaction_id }}</td>
                    <td>{{ $payment->billAmount->bill->customer->name ?? '-' }}</td>
                    <td>{{ $payment->billAmount->bill->service->name ?? '-' }}</td>
                    <td>{{ number_format($payment->amount, 2) }} جنيه</td>
                    <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
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
