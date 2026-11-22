<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library App</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Arial, sans-serif; background: #f5f5f5; padding: 2rem; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,.05); max-width: 700px; margin: 0 auto; }
        code { background: #f1f1f1; padding: 2px 6px; border-radius: 4px; }
        ul { padding-right: 1.5rem; }
        li { margin-bottom: .5rem; }
        h1 { color: #1f2937; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Library App API</h1>
        <p>نظام إدارة المكتبة. استخدم واجهة الـ API عبر:</p>
        <p><code>GET /api/v1/books</code></p>

        <h2>التثبيت السريع</h2>
        <ul>
            <li><code>composer install</code></li>
            <li><code>cp .env.example .env</code></li>
            <li><code>php artisan key:generate</code></li>
            <li><code>php artisan migrate --seed</code></li>
            <li><code>php artisan serve</code></li>
        </ul>

        <h2>حسابات تجريبية</h2>
        <ul>
            <li>Admin: <code>admin@library.test</code> / <code>password</code></li>
            <li>Librarian: <code>librarian@library.test</code> / <code>password</code></li>
            <li>Member: <code>member@library.test</code> / <code>password</code></li>
        </ul>
    </div>
</body>
</html>
