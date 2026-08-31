# Laravel Product Management CRUD

This is a simple Product Management module built with Laravel, as per the given requirements. It allows an admin to add, view, edit, and delete products. 

## Features
- Complete Laravel source code using MVC architecture.
- SQLite database configured out of the box.
- Eloquent ORM and database migrations for the `products` table.
- CRUD operations for products (Create, Read, Update, Delete).
- Form validation for required fields, numeric price, and integer quantity.
- Responsive user interface styled with Bootstrap 5 (CDN).
- Flash session success messages.

## Setup Instructions

### Prerequisites
- PHP 8.2 or higher
- Composer

### Installation
1. Navigate to the project directory:
   ```bash
   cd CRUD
   ```
2. Install dependencies (if not already installed):
   ```bash
   composer install
   ```
3. The `.env` file should already be present. If not, copy `.env.example` to `.env` and generate the app key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Run the database migrations (SQLite is used by default):
   ```bash
   php artisan migrate
   ```
5. Start the local development server:
   ```bash
   php artisan serve
   ```
6. Open your browser and navigate to:
   [http://localhost:8000](http://localhost:8000) (or the URL provided by the server). You will automatically be redirected to `/products`.
