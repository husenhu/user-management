# User Management
User Management System using Laravel and Filament.

## Clone this repository
You can using this **User Management** for free.

## Rename the .env.example
Rename .env.example to .env and edit the parameter. You just need change this part.
```
APP_NAME=Laravel
APP_URL=http://localhost

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```
change to this:
```
APP_NAME="Your App"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_user_database
DB_PASSWORD=your_password_database
```

## How to Install
```
composer update
php artisan migrate
php artisan key:generate
php artisan storage:link
php artisan make:filament-user
```
