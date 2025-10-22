<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - نظام الدفع الجامعي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --baby-blue: #4E71FF;
            --light-blue: #7B93FF;
            --pale-blue: #E8EDFF;
        }

        body {
            font-family: 'Cairo', 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--baby-blue) 0%, var(--light-blue) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .login-header {
            background: var(--baby-blue);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .login-header i {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .login-header h3 {
            margin: 0;
            font-weight: bold;
        }

        .login-header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-label {
            font-weight: 600;
            color: #2C3E50;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid var(--pale-blue);
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--baby-blue);
            box-shadow: 0 0 0 0.2rem rgba(78, 113, 255, 0.15);
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #95A5A6;
        }

        .input-icon .form-control {
            padding-right: 45px;
        }

        .btn-login {
            background: var(--baby-blue);
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: var(--light-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 113, 255, 0.3);
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: #721c24;
            border-right: 4px solid #dc3545;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: #155724;
            border-right: 4px solid #28a745;
        }

        .form-check-input:checked {
            background-color: var(--baby-blue);
            border-color: var(--baby-blue);
        }

        .form-check-label {
            color: #2C3E50;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <i class="bi bi-mortarboard-fill"></i>
                <h3>نظام الدفع الجامعي</h3>
                <p>لوحة التحكم</p>
            </div>

            <div class="login-body">
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <i class="bi bi-exclamation-triangle-fill ms-2"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success mb-4">
                        <i class="bi bi-check-circle-fill ms-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="user_type" class="form-label">
                                    <i class="bi bi-person-badge-fill me-2"></i>نوع المستخدم
                                </label>
                                <select class="form-select @error('user_type') is-invalid @enderror"
                                        id="user_type" name="user_type" required>
                                    <option value="">اختر نوع المستخدم</option>
                                    <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>
                                        مدير النظام (Admin)
                                    </option>
                                    <option value="student" {{ old('user_type') == 'student' ? 'selected' : '' }}>
                                        طالب (Student)
                                    </option>
                                </select>
                                @error('user_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope-fill me-2"></i>البريد الإلكتروني
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}"
                                       placeholder="أدخل بريدك الإلكتروني" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock-fill me-2"></i>كلمة المرور
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password"
                                       placeholder="أدخل كلمة المرور" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    تذكرني
                                </label>
                            </div>                    <button type="submit" class="btn btn-login">
                        <i class="bi bi-box-arrow-in-right ms-2"></i>
                        تسجيل الدخول
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
