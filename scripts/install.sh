echo "Installing Project..."

composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

echo "Project Installed!"
