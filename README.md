# Laravel Product Management System

This project is a Product Management System built using Laravel. It includes Product Management, Category Management, Supplier Management, and Product Purchase Entry functionality.

The system supports product CRUD operations along with search, category filtering, stock filtering, price sorting, pagination, supplier management, purchase entries, and automatic product stock updates.

## Features

### Product Management

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

## Category Management

* Add categories
* View categories
* Edit categories
* Delete categories
* Assign products to categories
* Display products with their related category

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

## Supplier Management

The Supplier Management module allows suppliers to be managed separately.

Features include:

* Add suppliers
* View all suppliers
* Edit supplier details
* Delete suppliers safely
* Supplier name
* Phone number
* Email address
* Address
* Active or Inactive status

Supplier validation includes:

* Supplier name is required
* Phone number is required
* Email is optional but must be valid
* Address is optional
* Status is required

If a supplier has existing purchase records, the supplier is handled safely to avoid accidentally removing important purchase history.

## Purchase Management

The Purchase Management module allows new product purchases to be recorded.

Features include:

* Create purchase entries
* Select a supplier
* Add invoice number
* Select purchase date
* Add multiple products to one purchase
* Enter quantity
* Enter purchase price
* Automatically calculate item subtotal
* Automatically calculate purchase total
* View purchase history
* View complete purchase details

## Purchase Calculation

The purchase item subtotal is calculated as:

```text
Subtotal = Quantity × Purchase Price
```

Example:

```text
Quantity = 5
Purchase Price = ₹500
Subtotal = ₹2,500
```

The total purchase amount is calculated as:

```text
Total Amount = Sum of all Purchase Item Subtotals
```

The total amount is calculated on the backend before saving the purchase.

The application does not trust the total value sent directly from the browser.

## Automatic Stock Update

When a purchase is successfully created, the purchased quantity is automatically added to the existing product stock.

Example:

```text
Existing Product Stock = 5
Purchased Quantity = 3
Updated Product Stock = 8
```

Product stock is updated using the database after the purchase is successfully created.

## Database Transaction

Purchase creation uses a Laravel database transaction.

The following operations are completed together:

* Create Purchase
* Create Purchase Items
* Update Product Stock

If an error occurs during any of these operations, the transaction is rolled back.

This prevents incomplete purchase records or incorrect product stock updates.

## Purchase Details

The Purchase Details page displays:

* Invoice Number
* Supplier
* Purchase Date
* Purchased Products
* Quantity
* Purchase Price
* Item Subtotal
* Total Amount

Example:

```text
Invoice: INV-001
Supplier: ABC Mobiles
Purchase Date: 02-09-2026

Product          Quantity       Price        Subtotal
iPhone 15        2              ₹50,000      ₹100,000
USB Cable        10             ₹300        ₹3,000

Total Amount: ₹103,000
```

## Database Relationships

The following Eloquent relationships are implemented.

### Category

A Category can have multiple Products.

```text
Category
    hasMany
Product
```

### Product

A Product belongs to a Category.

```text
Product
    belongsTo
Category
```

A Product can have multiple Purchase Items.

```text
Product
    hasMany
PurchaseItem
```

### Supplier

A Supplier can have multiple Purchases.

```text
Supplier
    hasMany
Purchase
```

### Purchase

A Purchase belongs to a Supplier.

```text
Purchase
    belongsTo
Supplier
```

A Purchase can have multiple Purchase Items.

```text
Purchase
    hasMany
PurchaseItem
```

### Purchase Item

A Purchase Item belongs to a Purchase.

```text
PurchaseItem
    belongsTo
Purchase
```

A Purchase Item belongs to a Product.

```text
PurchaseItem
    belongsTo
Product
```

## Main Routes

### Products

```text
GET     /products
GET     /products/create
POST    /products
GET     /products/{product}/edit
PUT     /products/{product}
DELETE  /products/{product}
```

### Suppliers

```text
GET     /suppliers
GET     /suppliers/create
POST    /suppliers
GET     /suppliers/{supplier}/edit
PUT     /suppliers/{supplier}
DELETE  /suppliers/{supplier}
```

### Purchases

```text
GET     /purchases
GET     /purchases/create
POST    /purchases
GET     /purchases/{purchase}
```

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
http://127.0.0.1:8000/products
```

## Database

This project uses SQLite.

The database connection is configured in the `.env` file:

```env
DB_CONNECTION=sqlite
```

The application includes database tables for:

* Categories
* Products
* Suppliers
* Purchases
* Purchase Items

## Technologies Used

* PHP
* Laravel
* Eloquent ORM
* Blade
* SQLite
* Tailwind CSS
* JavaScript

## Project Structure

```text
app/
├── Http/
│   └── Controllers/
│       ├── ProductController.php
│       ├── CategoryController.php
│       ├── SupplierController.php
│       └── PurchaseController.php
│
└── Models/
    ├── Product.php
    ├── Category.php
    ├── Supplier.php
    ├── Purchase.php
    └── PurchaseItem.php

database/
└── migrations/
    ├── create_categories_table.php
    ├── create_products_table.php
    ├── create_suppliers_table.php
    ├── create_purchases_table.php
    └── create_purchase_items_table.php

resources/
└── views/
    ├── products/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   └── edit.blade.php
    │
    ├── suppliers/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   └── edit.blade.php
    │
    └── purchases/
        ├── index.blade.php
        ├── create.blade.php
        └── show.blade.php

routes/
└── web.php

