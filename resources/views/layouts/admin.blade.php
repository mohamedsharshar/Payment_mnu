<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم') - نظام الدفع الجامعي</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --baby-blue: #4E71FF;
            --light-blue: #7B93FF;
            --pale-blue: #E8EDFF;
            --white: #FFFFFF;
            --text-dark: #2C3E50;
            --gray: #95A5A6;
        }

        body {
            font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #F8FAFB;
            min-height: 100vh;
        }

        .sidebar {
            background: var(--white);
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(78, 113, 255, 0.15);
            position: fixed;
            right: 0;
            top: 0;
            width: 260px;
            z-index: 1000;
            transition: all 0.3s ease;
            border-left: 3px solid var(--baby-blue);
        }

        .sidebar .logo {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 2px solid var(--pale-blue);
            background: var(--baby-blue);
        }

        .sidebar .logo h4 {
            color: var(--white);
            font-weight: bold;
            margin: 0;
            font-size: 1.3rem;
        }

        .sidebar .logo p {
            color: var(--white);
            font-size: 0.85rem;
            margin: 5px 0 0;
            opacity: 0.9;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu a {
            color: var(--text-dark);
            text-decoration: none;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border-right: 3px solid transparent;
        }

        .sidebar-menu a:hover {
            background: var(--pale-blue);
            color: var(--baby-blue);
            border-right-color: var(--baby-blue);
        }

        .sidebar-menu a.active {
            background: var(--baby-blue);
            color: var(--white);
            border-right-color: var(--baby-blue);
            font-weight: bold;
        }

        .sidebar-menu a i {
            margin-left: 12px;
            font-size: 1.2rem;
        }

        .sidebar-menu form button {
            display: flex;
            align-items: center;
            width: 100%;
            text-align: right;
        }

        .sidebar-menu form button:hover {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-right: 3px solid #dc3545 !important;
        }

        .main-content {
            margin-right: 260px;
            padding: 30px;
            transition: all 0.3s ease;
        }

        .topbar {
            background: var(--white);
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(78, 113, 255, 0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 4px solid var(--baby-blue);
        }

        .topbar h2 {
            margin: 0;
            color: var(--text-dark);
            font-size: 1.8rem;
            font-weight: bold;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--baby-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
            font-size: 1.1rem;
            border: 2px solid var(--pale-blue);
        }

        .card {
            border: 1px solid var(--pale-blue);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(78, 113, 255, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 25px;
            background: var(--white);
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(78, 113, 255, 0.2);
        }

        .card-header {
            background: var(--baby-blue);
            color: var(--white);
            border: none;
            border-radius: 12px 12px 0 0 !important;
            padding: 20px;
            font-weight: bold;
        }

        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            border: 2px solid var(--pale-blue);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            border-color: var(--baby-blue);
            box-shadow: 0 4px 12px rgba(78, 113, 255, 0.15);
        }

        .stat-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 15px;
            background: var(--baby-blue);
            color: var(--white);
        }

        .stat-card h6 {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .stat-card h3 {
            color: var(--text-dark);
            font-weight: bold;
            margin: 0;
            font-size: 2rem;
        }

        .btn-primary {
            background: var(--baby-blue);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--light-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 113, 255, 0.3);
        }

        .btn-outline-primary {
            border: 2px solid var(--baby-blue);
            color: var(--baby-blue);
            background: var(--white);
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--white);
            color: var(--baby-blue);
            transform: translateY(-2px);
        }

        .btn-success {
            background: #1E8E3E;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: var(--white);
        }

        .btn-success:hover {
            background: #2DA44E;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #C53929;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: var(--white);
        }

        .btn-danger:hover {
            background: #D73A49;
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 6px 15px;
            font-size: 0.875rem;
        }

        .table {
            background: var(--white);
        }

        .table thead {
            background: var(--baby-blue);
            color: var(--white);
        }

        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid var(--pale-blue);
        }

        .table tbody tr:hover {
            background: var(--pale-blue);
        }

        .table tbody td {
            padding: 12px 15px;
        }

        .badge {
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 600;
        }

        .badge-success {
            background: #38c959;
            color: var(--white);
        }

        .badge-warning {
            background: linear-gradient(135deg, #ffc107, #fd7e14);
        }

        .badge-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
        }

        .badge-primary {
            background: var(--baby-blue);
            color: var(--white);
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 15px 20px;
            border-right: 4px solid;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            border-right-color: #28a745;
            color: #155724;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            border-right-color: #dc3545;
            color: #721c24;
        }

        .alert-info {
            background: rgba(78, 113, 255, 0.1);
            border-right-color: var(--baby-blue);
            color: var(--text-dark);
        }

        .custom-pagination {
            gap: 8px;
            margin: 20px 0;
        }

        .custom-pagination .page-item {
            border-radius: 10px;
        }

        .custom-pagination .page-link {
            border: 2px solid var(--light-blue);
            color: var(--baby-blue);
            border-radius: 10px;
            padding: 10px 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            background: white;
            min-width: 45px;
            text-align: center;
        }

        .custom-pagination .page-link:hover {
            background: var(--light-blue);
            border-color: var(--baby-blue);
            color: var(--text-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 113, 255, 0.2);
        }

        .custom-pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--light-blue), var(--baby-blue));
            border-color: var(--baby-blue);
            color: white;
            box-shadow: 0 4px 15px rgba(78, 113, 255, 0.3);
        }

        .custom-pagination .page-item.disabled .page-link {
            background: #f8f9fa;
            border-color: #e9ecef;
            color: #adb5bd;
            cursor: not-allowed;
        }

        .custom-pagination .page-link i {
            font-size: 1rem;
            vertical-align: middle;
        }

        .form-control, .form-select {
            border: 1px solid var(--pale-blue);
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--baby-blue);
            box-shadow: 0 0 0 0.2rem rgba(78, 113, 255, 0.15);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        @media print {
            body {
                background: white;
            }
            .sidebar, .topbar, .btn, .pagination {
                display: none !important;
            }
            .main-content {
                margin: 0;
                padding: 0;
            }
            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
            .table {
                border: 1px solid #ddd;
            }
            .table thead {
                background: white !important;
            }
            .table tbody tr {
                background: white !important;
            }
            .table th, .table td {
                border: 1px solid #ddd !important;
                color: #333 !important;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .main-content {
                margin-right: 0;
            }

            .sidebar.show {
                width: 260px;
            }
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    @stack('styles')
</head>
<body>

    <div class="sidebar">
        <div class="logo">
            <h4><i class="bi bi-mortarboard-fill"></i> نظام الدفع</h4>
            <p>الجامعي</p>
        </div>

        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>لوحة التحكم</span>
            </a>

            <a href="{{ route('admin.customers.index') }}" class="{{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>الطلاب</span>
            </a>

            <a href="{{ route('admin.bills.index') }}" class="{{ request()->routeIs('admin.bills.*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i>
                <span>الفواتير</span>
            </a>

            <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>الخدمات</span>
            </a>

            <a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                <i class="bi bi-credit-card"></i>
                <span>المدفوعات</span>
            </a>

            <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="bi bi-graph-up"></i>
                <span>التقارير</span>
            </a>

            <hr style="border-color: rgba(255,255,255,0.1); margin: 10px 0;">

            <a href="{{ route('admin.restore.customers') }}" class="{{ request()->routeIs('admin.restore.customers*') ? 'active' : '' }}">
                <i class="bi bi-trash"></i>
                <span>سلة المحذوفات - الطلاب</span>
            </a>

            <a href="{{ route('admin.restore.bills') }}" class="{{ request()->routeIs('admin.restore.bills*') ? 'active' : '' }}">
                <i class="bi bi-trash"></i>
                <span>سلة المحذوفات - الفواتير</span>
            </a>

            <a href="{{ route('admin.restore.services') }}" class="{{ request()->routeIs('admin.restore.services*') ? 'active' : '' }}">
                <i class="bi bi-trash"></i>
                <span>سلة المحذوفات - الخدمات</span>
            </a>

            <a href="{{ route('admin.restore.users') }}" class="{{ request()->routeIs('admin.restore.users*') ? 'active' : '' }}">
                <i class="bi bi-trash"></i>
                <span>سلة المحذوفات - المستخدمين</span>
            </a>

            <hr style="border-color: rgba(255,255,255,0.1); margin: 10px 0;">

            <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i>
                <span>الإعدادات</span>
            </a>

            <form action="{{ route('logout') }}" method="POST" style="padding: 0;">
                @csrf
                <button type="submit" class="btn w-100 text-end" style="color: var(--text-dark); padding: 15px 25px; border: none; background: transparent; transition: all 0.3s ease; border-right: 3px solid transparent;">
                    <i class="bi bi-box-arrow-right" style="margin-left: 12px; font-size: 1.2rem;"></i>
                    <span>تسجيل الخروج</span>
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div>
                <h2>@yield('page-title', 'لوحة التحكم')</h2>
            </div>

            <div class="user-info">
                <div>
                    <strong>{{ Auth::user()->name }}</strong>
                    <p class="mb-0 text-muted" style="font-size: 0.85rem;">
                        @if(Auth::user()->hasRole('admin'))
                            <i class="bi bi-shield-fill-check me-1"></i>مدير النظام
                        @elseif(Auth::user()->hasRole('student'))
                            <i class="bi bi-person-fill me-1"></i>طالب
                        @else
                            <i class="bi bi-person-circle me-1"></i>مستخدم
                        @endif
                    </p>
                </div>
                <div class="user-avatar">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill ms-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill ms-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>
</html>
