# Requirements

1. PHP 8+
2. Composer
3. Laravel 11
4. MySQL / MariaDB

⚙️ Installation & Setup
1️⃣ Clone the repository
git clone https://github.com/artisanbaba/Book-Review-App-In-Laravel-11.git
cd Book-Review-App-In-Laravel-11

2️⃣ Install dependencies
composer install

3️⃣ Configure environment
cp .env.example .env
php artisan key:generate

Update your .env with database details:

DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=

4️⃣ Run migrations
php artisan migrate

5️⃣ Start development server
php artisan serve

Now visit:
👉 http://localhost:8000
