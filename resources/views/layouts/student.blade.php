<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'بوابة الطالب')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4E71FF;
            --light-blue: #7B93FF;
            --pale-blue: #E8EDFF;
            --success-color: #38c959;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            width: 260px;
            background: white;
            box-shadow: -2px 0 10px rgba(0,0,0,0.05);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 25px 20px;
            background: var(--primary-color);
            color: white;
            text-align: center;
        }

        .sidebar-header h4 {
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: #495057;
            text-decoration: none;
            transition: all 0.3s;
            border-right: 3px solid transparent;
        }

        .menu-item:hover,
        .menu-item.active {
            background: var(--pale-blue);
            color: var(--primary-color);
            border-right-color: var(--primary-color);
        }

        .menu-item i {
            font-size: 1.3rem;
            margin-left: 12px;
            min-width: 25px;
        }

        .menu-item span {
            font-size: 1rem;
            font-weight: 500;
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
        }

        .logout-btn button {
            width: 100%;
            padding: 12px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .logout-btn button:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .main-content {
            margin-right: 260px;
            padding: 0;
            min-height: 100vh;
        }

        .topbar {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .topbar h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .content-wrapper {
            padding: 0 30px 30px 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
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
        }

        .stat-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-card p {
            color: #6c757d;
            margin: 0;
            font-size: 0.95rem;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .card-header {
            background: var(--primary-color);
            color: white;
            border-radius: 12px 12px 0 0 !important;
            padding: 15px 20px;
            font-weight: 600;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--light-blue);
            transform: translateY(-2px);
        }

        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
        }

        .badge-success {
            background: var(--success-color);
        }

        .badge-warning {
            background: var(--warning-color);
        }

        .badge-danger {
            background: var(--danger-color);
        }

        .table {
            margin: 0;
        }

        .table thead th {
            background: var(--pale-blue);
            color: var(--primary-color);
            font-weight: 700;
            border: none;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="bi bi-person-circle"></i> بوابة الطالب</h4>
        </div>

        <div class="sidebar-menu">
            <a href="{{ route('student.dashboard') }}" class="menu-item {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i>
                <span>الصفحة الرئيسية</span>
            </a>

            <a href="{{ route('student.faculty') }}" class="menu-item {{ request()->routeIs('student.faculty') ? 'active' : '' }}">
                <i class="bi bi-building"></i>
                <span>بيانات الكلية</span>
            </a>

            <a href="{{ route('student.receipts.index') }}" class="menu-item {{ request()->routeIs('student.receipts.*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i>
                <span>الإيصالات</span>
            </a>
        </div>

        <div class="logout-btn">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <i class="bi bi-box-arrow-left ms-2"></i>تسجيل الخروج
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div>
                <h2>@yield('page-title', 'بوابة الطالب')</h2>
            </div>

            <div class="user-info">
                <div>
                    <strong>{{ Auth::user()->name }}</strong>
                    <p class="mb-0 text-muted" style="font-size: 0.85rem;">
                        <i class="bi bi-person-fill me-1"></i>طالب
                    </p>
                </div>
                <div class="user-avatar">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="content-wrapper">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill ms-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="content-wrapper">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill ms-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
