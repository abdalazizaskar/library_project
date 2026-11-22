# Library App — نظام مكتبة بسيط (Laravel + API)

مشروع مبسّط وفق أساسيات المحاضرات: Models، Migrations، Controllers، Form Request، API Resource، Service، Routes، وSanctum.

## التثبيت

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

حساب تجريبي بعد الـ seed: `user@library.test` / `password`

## المسارات الأساسية

- `POST /api/v1/auth/register`
- `POST /api/v1/auth/login`
- `GET  /api/v1/books`
- `POST /api/v1/books` (يحتاج token)
- `POST /api/v1/borrowings` — `{ "book_id": 1 }`
"# library_project" 
