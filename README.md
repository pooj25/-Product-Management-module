# Laravel Product Management CRUD

This project is a Product Management module built using Laravel. It supports product CRUD operations along with search, category filtering, stock filtering, price sorting, and pagination.

## Features

* Add new products
* View all products
* Edit products
* Delete products
* Search products by name and description
* Filter products by category
* Filter products by stock status
* Sort products by price
* Display 10 products per page
* Preserve search and filter values during pagination
* Display stock status based on product quantity
* Clear all active filters
* Display a message when no products are found
* Form validation
* Flash success messages

## Product Search

Products can be searched using the product name or description.

Example:

```text
/products?search=iphone
```

Searching for `iphone` will display products where the product name or description contains `iphone`.

## Category Filter

Products can be filtered based on their category.

The available categories are loaded from the database.

Example:

```text
/products?category=1
```

## Stock Status Filter

Stock status is calculated using the product quantity.

* Quantity 0 - Out of Stock
* Quantity 1 to 5 - Low Stock
* Quantity greater than 5 - In Stock

The stock status is not stored as a separate database field.

Example:

```text
/products?stock=low_stock
```

Available stock filters:

* In Stock
* Low Stock
* Out of Stock

## Price Sorting

Products can be sorted by price.

Available options:

* Default
* Price: Low to High
* Price: High to Low

Examples:

```text
/products?sort=price_asc
```

```text
/products?sort=price_desc
```

## Multiple Filters

Multiple filters can be used together.

Example:

```text
/products?search=iphone&category=1&stock=in_stock&sort=price_asc
```

## Pagination

Laravel's built-in pagination is used to display products.

* Maximum 10 products per page
* Pagination is handled using Eloquent
* Products are filtered before pagination
* Search and filter values remain active when moving between pages

## Clear Filters

The Clear Filters button removes all search and filter parameters and displays the complete product list.

## No Results

If no products match the selected search or filter conditions, the application displays:

```text
No products found.
```

A Clear Filters button is also provided to reset the filters.

## Product Listing

The product listing page displays:

* Product Name
* Category
* Description
* Price
* Quantity
* Stock Status
* Edit Action
* Delete Action

## Setup Instructions

### Prerequisites

* PHP 8.2 or higher
* Composer

### Installation

1. Navigate to the project directory:

```bash
cd CRUD
```

2. Install dependencies:

```bash
composer install
```

3. If the `.env` file is not available, create it from `.env.example`:

```bash
cp .env.example .env
```

4. Generate the application key:

```bash
php artisan key:generate
```

5. Run the migrations:

```bash
php artisan migrate
```

6. Start the Laravel development server:

```bash
php artisan serve
```

7. Open the application in the browser:

```text
http://localhost:8000/products
```

## Database

This project uses SQLite.

The database connection is configured in the `.env` file:

```env
DB_CONNECTION=sqlite
```

## Technologies Used

* PHP
* Laravel
* Eloquent ORM
* Blade
* SQLite
* Tailwind CSS

## Project Structure

```text
app/
├── Http/
│   └── Controllers/
│       └── ProductController.php
│
└── Models/
    ├── Product.php
    └── Category.php

resources/
└── views/
    └── products/
        ├── index.blade.php
        ├── create.blade.php
        └── edit.blade.php

routes/
└── web.php
```
