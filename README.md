# Exchange Calculator

This is an application writen in PHP's Laravel to query exchange rates

## About

This application run on PHP's Laravel framework

This application also uses Composer to handle dependencies. So, to run this application you must have installed on your environment:

* PHP (_https://www.php.net/manual/en/install.php_)
* Composer (_https://getcomposer.org/download/_)
* MySQL 5.x (_https://dev.mysql.com/doc/refman/5.7/en/installing.html_)
* An SQL client application, such as MySQL Workbench (_https://www.mysql.com/products/workbench/_) or DBeaver (_https://dbeaver.io/download/_)

## Installation
Once you have all necessary applications intalled on your environment, it's time to set up the app itself. For this, start by cloning this repository on a folder of your choosing, and then move into the newly created folder.

1. First, install all the project's dependencies by running the following:
```
composer install
```

2. Get the app running with:
```
php artisan serve
```

3. Then create a file named `.env` from the `.env.example` file by running:
```
cp .env.example .env
```
Make sure you set up your database information accordingly on the following configurations keys on the `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ot_db
DB_USERNAME=root
DB_PASSWORD=
```
This is just an example, the HOST, PORT, USERNAME and PASSWORD depends on the data you used when setting up your database server.
Also, don't forget to create an "ot_db" database with default charset configuration (ug UTF-8) using your chosen database client

4. You're nearly there! Next you need to run Laravel's application key generation command. Laravel use this key for cross-request authentication. Use:
```
php artisan key:generate
```

5. In order for Laravel be able to write logs on your system, you must allowed it to do so. So run the following:
```
chmod -R 777 storage/
```

6. Now you must run the migration to create your app's tables. Use this:
```
php artisan migrate
```

7. And you're done! If you run into any troubles try cleaning Laravel's cache. Use:
```
php artisan cache:clear
```

## Usage
To use this app, access it on your browser with the following URL `http://localhost:8000/`. 

From the main page you can either:
* Create a user login and be authenticated automatically
* Log in with a previously created user

From the authenticated main page you can now
* Pick a from and to currency and get an conversion amount with taxes applied. The retrieved data is automatically stored for future reviews
