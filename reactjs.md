- Author- Developer Naelson
- Test to Jobs 
- Laravel 8 and note see the requirements 
- Note, like taken look on PDFs don't have update endpoit describe, but did it
### database name

 ```
composer require laravel/ui
php artisan ui react => Please run "npm install && npm run dev" to compile your fresh scaffolding.
npm install && npm run dev
 ```
### error react not defined and point to public/js/app
- above error solve with below instuctions 
 
Are you familiar with any build tools like webpack, grunt, gulp, etc? Those are commonly used to bundle your application resources and move them to the desired destination, i.e. public in your case. I'd suggest reading some intro material to webpack as it is very often used in laravel + vuejs projects.

There are additional scripts in the package.json file that will run mom tasks too.

You will find  ``` npm run dev  ``` for local development and  ```npm run prod ``` for production.
- after this ``` npm run watch  ``` it hold allow alway const compiler everytime
- like this above, it compiler from resource/js/app.js to public/js/ 
- - https://laravel.com/docs/8.x/mix 


 ```

php artisan cache:clear
php artisan route:clear
php artisan config:clear 
php artisan view:clear


 ```