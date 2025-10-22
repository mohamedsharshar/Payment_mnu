<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>انتهت صلاحية الصفحة - 419</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #4E71FF 0%, #7B93FF 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-container {
            text-align: center;
            background: white;
            padding: 60px 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-width: 500px;
        }

        .error-icon {
            font-size: 5rem;
            color: #ffc107;
            margin-bottom: 20px;
        }

        .error-code {
            font-size: 4rem;
            font-weight: bold;
            color: #4E71FF;
            margin: 0;
        }

        .error-message {
            font-size: 1.3rem;
            color: #2c3e50;
            margin: 20px 0;
            font-weight: 600;
        }

        .error-description {
            color: #6c757d;
            margin-bottom: 30px;
            font-size: 1rem;
        }

        .btn-primary {
            background: #4E71FF;
            border: none;
            padding: 12px 40px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: #7B93FF;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 113, 255, 0.3);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <i class="bi bi-clock-history error-icon"></i>
        <h1 class="error-code">419</h1>
        <p class="error-message">انتهت صلاحية الصفحة</p>
        <p class="error-description">
            انتهت صلاحية جلسة المتصفح. يرجى تحديث الصفحة أو تسجيل الدخول مرة أخرى.
        </p>
        <a href="{{ route('login') }}" class="btn btn-primary">
            <i class="bi bi-arrow-clockwise me-2"></i>
            تسجيل الدخول
        </a>
    </div>

    <script>
        // Auto redirect after 3 seconds
        setTimeout(function() {
            window.location.href = "{{ route('login') }}";
        }, 3000);
    </script>
</body>
</html>
