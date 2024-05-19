echo "Installing Project..."

composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
echo "Project Installed!"

php artisan serve
