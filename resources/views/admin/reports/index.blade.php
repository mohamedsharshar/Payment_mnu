@extends('layouts.admin')

@section('title', 'التقارير والإحصائيات')
@section('page-title', 'التقارير والإحصائيات')

@section('content')
<div class="container-fluid">
    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-funnel me-2"></i>تصفية التقارير</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.reports.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">نوع التقرير</label>
                    <select name="report_type" class="form-select" id="reportType">
                        <option value="customers" {{ request('report_type') == 'customers' ? 'selected' : '' }}>الطلاب</option>
                        <option value="bills" {{ request('report_type') == 'bills' ? 'selected' : '' }}>الفواتير</option>
                        <option value="payments" {{ request('report_type') == 'payments' ? 'selected' : '' }}>المدفوعات</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">من تاريخ</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">إلى تاريخ</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">بحث</label>
                    <input type="text" name="search" class="form-control" placeholder="ابحث..." value="{{ request('search') }}">
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-2"></i>عرض التقرير
                    </button>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise me-2"></i>إعادة تعيين
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Export Buttons -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-3"><i class="bi bi-download me-2"></i>تصدير التقرير</h5>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-danger" onclick="exportReport('pdf')">
                    <i class="bi bi-file-pdf me-2"></i>PDF
                </button>
                <button type="button" class="btn btn-success" onclick="exportReport('excel')">
                    <i class="bi bi-file-excel me-2"></i>Excel
                </button>
                <button type="button" class="btn btn-info" onclick="exportReport('csv')">
                    <i class="bi bi-file-text me-2"></i>CSV
                </button>
            </div>
            <button type="button" class="btn btn-outline-primary ms-3" onclick="window.print()">
                <i class="bi bi-printer me-2"></i>طباعة
            </button>
        </div>
    </div>

    <!-- Statistics Summary -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="icon">
                    <i class="bi bi-people"></i>
                </div>
                <h6>إجمالي الطلاب</h6>
                <h3>{{ $totalCustomers }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="icon">
                    <i class="bi bi-receipt"></i>
                </div>
                <h6>إجمالي الفواتير</h6>
                <h3>{{ $totalBills }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="icon">
                    <i class="bi bi-cash-coin"></i>
                </div>
                <h6>إجمالي المدفوعات</h6>
                <h3>{{ $totalPayments }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="icon">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <h6>إجمالي المبالغ</h6>
                <h3>{{ number_format($totalAmount, 2) }} جنيه</h3>
            </div>
        </div>
    </div>

    <!-- Report Data Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-table me-2"></i>بيانات التقرير</h5>
        </div>
        <div class="card-body">
            @if(request('report_type') == 'customers' || !request('report_type'))
                <h6 class="mb-3">تقرير الطلاب</h6>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>الكود</th>
                                <th>الاسم</th>
                                <th>الوصف</th>
                                <th>الهاتف</th>
                                <th>البريد الإلكتروني</th>
                                <th>الكلية</th>
                                <th>المستوى</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $customer)
                                <tr>
                                    <td>{{ $customer->Code }}</td>
                                    <td>{{ $customer->Name }}</td>
                                    <td>{{ $customer->Description }}</td>
                                    <td>{{ $customer->Mobile }}</td>
                                    <td>{{ $customer->Email }}</td>
                                    <td>{{ optional($customer->faculty)->Name ?? '-' }}</td>
                                    <td>{{ optional($customer->userLevel)->Name ?? '-' }}</td>
                                    <td>{{ $customer->CreatedIn }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">لا توجد بيانات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $customers->links('vendor.pagination.bootstrap-5') }}
            @endif

            @if(request('report_type') == 'bills')
                <h6 class="mb-3">تقرير الفواتير</h6>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>رقم الفاتورة</th>
                                <th>اسم الطالب</th>
                                <th>الخدمة</th>
                                <th>المبلغ</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bills as $bill)
                                <tr>
                                    <td>{{ $bill->id }}</td>
                                    <td>{{ $bill->customer->name ?? '-' }}</td>
                                    <td>{{ $bill->service->name ?? '-' }}</td>
                                    <td>{{ number_format($bill->amount, 2) }} جنيه</td>
                                    <td>
                                        @if($bill->status == 'paid')
                                            <span class="badge badge-success">مدفوع</span>
                                        @elseif($bill->status == 'pending')
                                            <span class="badge badge-warning">قيد الانتظار</span>
                                        @else
                                            <span class="badge badge-danger">ملغي</span>
                                        @endif
                                    </td>
                                    <td>{{ $bill->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">لا توجد بيانات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $bills->links('vendor.pagination.bootstrap-5') }}
            @endif

            @if(request('report_type') == 'payments')
                <h6 class="mb-3">تقرير المدفوعات</h6>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>رقم العملية</th>
                                <th>رقم المعاملة</th>
                                <th>اسم الطالب</th>
                                <th>الخدمة</th>
                                <th>المبلغ</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->transaction_id }}</td>
                                    <td>{{ $payment->billAmount->bill->customer->name ?? '-' }}</td>
                                    <td>{{ $payment->billAmount->bill->service->name ?? '-' }}</td>
                                    <td>{{ number_format($payment->amount, 2) }} جنيه</td>
                                    <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">لا توجد بيانات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $payments->links('vendor.pagination.bootstrap-5') }}
            @endif
        </div>
    </div>
</div>

<script>
    function exportReport(format) {
        const reportType = document.getElementById('reportType').value;
        const params = new URLSearchParams(window.location.search);
        params.set('export', format);
        params.set('report_type', reportType);

        window.location.href = '{{ route("admin.reports.export") }}?' + params.toString();
    }
</script>

<style>
    @media print {
        .sidebar, .topbar, .card-header button, .btn-group, .no-print,
        .btn, button, .form-control, select, input {
            display: none !important;
        }

        .main-content {
            margin-right: 0 !important;
            padding: 0 !important;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
            page-break-inside: avoid;
        }

        .card-header {
            background-color: #fff !important;
            color: #333 !important;
            border-bottom: 2px solid #333 !important;
        }

        .stat-card {
            border: 1px solid #ddd !important;
            box-shadow: none !important;
            background: #fff !important;
        }

        .stat-card .icon {
            background: #fff !important;
            color: #333 !important;
            border: 1px solid #ddd !important;
        }

        table {
            font-size: 11px !important;
        }

        th {
            background-color: #fff !important;
            color: #333 !important;
            border: 1px solid #333 !important;
        }

        td {
            background-color: #fff !important;
            border: 1px solid #ddd !important;
        }

        tr:nth-child(even) td {
            background-color: #f8f9fa !important;
        }

        .badge {
            background-color: #e8e8e8 !important;
            color: #333 !important;
            border: 1px solid #999 !important;
        }

        @page {
            size: A4 landscape;
            margin: 15mm;
        }
    }
</style>
@endsection

