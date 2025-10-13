## 📎 Cara Menjalankan

```bash
git clone https://github.com/pearlgw/swor.git
cd swor
cp .env.example .env
composer install
php artisan key:generate

# Jalankan Laravel
php artisan migrate
php artisan db:seed
php artisan ser
