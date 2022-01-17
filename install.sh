cp .env-docker .env
php artisan key:generate
composer require laravel/sail --dev
php artisan sail:install
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
./vendor/bin/sail up


