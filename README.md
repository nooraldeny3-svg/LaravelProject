# TechShop — Electronics E-Commerce Web Application

A full-featured e-commerce platform for browsing and purchasing electronics, built with Laravel.

## About the Project

TechShop allows users to browse products across categories like Smartphones, Laptops, Audio, Gaming, and Smart Devices. It includes a shopping cart, checkout flow, order tracking, and a complete admin panel.

## Features

- Browse products by category with search and filtering
- Product detail pages with related product suggestions
- Session-based shopping cart
- Checkout with shipping address and delivery date
- Order confirmation and order history for users
- Admin dashboard with full CRUD for products, categories, and orders
- Order status management (pending / confirmed / cancelled)
- Dark mode toggle (persisted across sessions)
- Role-based access control (admin / regular user)
- Responsive design — works on mobile, tablet, and desktop

## Tech Stack

- **Backend:** PHP 8.5, Laravel 13
- **Frontend:** HTML, CSS, JavaScript (no external CSS frameworks)
- **Database:** MySQL
- **Authentication:** Laravel Breeze

## Installation

```bash
# Clone the repository
git clone https://github.com/nooraldeny3-svg/LaravelProject.git
cd LaravelProject

# Install PHP dependencies
composer install

# Set up environment
cp .env.example .env
php artisan key:generate

# Configure your database in .env, then run:
php artisan migrate:fresh --seed

# Start the development server
php artisan serve
```

## Default Accounts

| Role  | Email | Password |
|-------|-------|----------|
| Admin | admin@admin.com | password |
| User  | user@example.com | password |

## Project Structure

- `app/Models/` — User, Product, Category, Order, OrderItem
- `app/Http/Controllers/` — Public + Admin controllers
- `resources/views/` — Blade templates (layouts, products, cart, checkout, admin)
- `database/seeders/` — 5 categories, 16 products, 2 demo users
- `routes/web.php` — Public, cart, auth-protected, and admin route groups

## License

This project is for educational purposes.
