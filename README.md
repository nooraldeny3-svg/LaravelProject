# TurkeyTours — Turkish Tourism Booking Web Application

A web-based e-commerce platform for booking tours across Turkey's most popular destinations, built with Laravel.

## About the Project

TurkeyTours allows users to browse and book tour packages across Turkish cities including Istanbul, Cappadocia, Antalya, and Pamukkale. The application includes a full admin panel for managing tours, cities, and orders.

## Features

- Browse tour packages by city
- Shopping cart and checkout system
- User registration and login
- My Bookings page for order history
- Admin dashboard with order, tour, and city management
- Role-based access control (admin / regular user)

## Tech Stack

- **Backend:** PHP 8.5, Laravel 13
- **Frontend:** HTML, CSS, JavaScript (no CSS frameworks)
- **Database:** MySQL
- **Authentication:** Laravel Breeze

## Installation

```bash
# Clone the repository
git clone https://github.com/nooraldeny3-svg/LaravelProject.git
cd LaravelProject

# Install dependencies
composer install

# Copy environment file and configure your database
cp .env.example .env
php artisan key:generate

# Run migrations and seeders
php artisan migrate --seed

# Start the server
php artisan serve
```

## Default Accounts

| Role  | Email | Password |
|-------|-------|----------|
| Admin | admin@admin.com | password |
| User  | user@example.com | password |

## License

This project is for educational purposes.
