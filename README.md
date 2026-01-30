Mini Project

This is a Laravel 12 project for a web and admin panel application. The project includes full admin authentication, user management, and dashboard features.

A demo video is available to see how the project works.

Features

Admin login/logout with custom guard (admin)

Admin dashboard

User management (CRUD)

Blade components for layout (admin & web)

Middleware protection for admin routes

Laravel 12 + PHP 8.4 compatible

Requirements

PHP >= 8.1

Composer

MySQL or any database supported by Laravel

Node.js & NPM (for frontend assets)

Installation Steps

Clone the repository

git clone https://github.com/afnanafnu/mini-project.git
cd mini-project


Install PHP dependencies

composer install


Install frontend dependencies

npm install


Copy .env file

cp .env.example .env


Set up environment variables

Configure database connection in .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_project
DB_USERNAME=root
DB_PASSWORD=


Generate application key

php artisan key:generate


Run migrations

php artisan migrate


Optional: Seed admin user

php artisan db:seed --class=AdminSeeder


Make sure passwords are hashed using bcrypt.

Build frontend assets

npm run dev


Start local server

php artisan serve


The project will be available at:

http://127.0.0.1:8000
