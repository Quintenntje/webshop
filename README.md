# Webshop - E-commerce Platform

A full-featured e-commerce webshop application built with Laravel, designed for selling shoes with comprehensive product management, shopping cart functionality, and payment processing.

## 🚀 Features

### Customer Features

-   **Product Catalog**

    -   Browse products by gender, brand, or category
    -   Product detail pages with multiple images
    -   Product variants (colors and sizes)
    -   Stock management and availability checking
    -   Product search functionality
    -   Sales page with discounted products

-   **Shopping Experience**

    -   Shopping cart with add, remove, and update functionality
    -   Wishlist to save favorite products
    -   Discount code system for cart-wide discounts
    -   Product-level discounts with expiration dates
    -   Real-time price calculations

-   **User Account**

    -   User registration and authentication
    -   Password reset functionality
    -   Account dashboard
    -   Address management (save multiple shipping addresses)
    -   Order history

-   **Checkout & Payment**

    -   Multi-step checkout process (shipping → payment)
    -   Guest checkout support
    -   Mollie payment integration (credit card, debit card, PayPal, bank transfer)
    -   Order confirmation emails
    -   Order status tracking (pending, paid, expired, canceled)

-   **Additional Features**
    -   Newsletter subscription with unsubscribe functionality
    -   Multi-language support (i18n)
    -   SEO optimization with meta tags and sitemap generation
    -   Responsive design with Tailwind CSS

### Admin Features

-   **Admin Panel** (Filament)
    -   Product management (create, edit, delete)
    -   Product variant management (colors, sizes, stock)
    -   Product image management
    -   Brand and gender management
    -   Order management and tracking
    -   Customer management
    -   Discount code management
    -   Wishlist overview
    -   User and role management

## 🛠️ Tech Stack

-   **Backend:** Laravel 12
-   **Frontend:** Blade templates, Tailwind CSS, Vite
-   **Database:** SQLite (development)
-   **Payment:** Mollie API
-   **Admin Panel:** Filament
-   **Localization:** Laravel Localization
-   **SEO:** SEO Tools, Sitemap Generator

## 📋 Prerequisites

-   Docker Desktop installed and running
-   DDEV installed
-   Node.js and npm installed

## 🏃 Getting Started

1. **Start Docker Desktop** - Ensure Docker Desktop is running on your machine.

2. **Start DDEV** - In the project root directory, run:

    ```bash
    ddev start
    ```

3. **Start the development server** - In a new terminal, run:

    ```bash
    npm run dev
    ```

4. **Access the application** - Open your browser and navigate to the URL provided by DDEV (typically `https://webshop-quintenntje.ddev.site`).

### Admin Access

-   **Email:** `admin@admin.com`
-   **Password:** `admin`

Access the admin panel at `/admin` after logging in with admin credentials.

## 🗄️ Database Setup

### Running Migrations

To create the database tables, run the migrations:

```bash
ddev artisan migrate
```

### Running Seeders

To populate the database with initial data (roles, genders, brands, products, customers, discount codes, and admin user):

```bash
ddev artisan db:seed
```

**Note:** The seeder will create the admin user (`admin@admin.com` / `admin`) automatically.

### Fresh Migration with Seeding

To reset the database and run all migrations and seeders from scratch:

```bash
ddev artisan migrate:fresh --seed
```

**Warning:** This will drop all existing tables and data, then recreate them with fresh seed data.

## 📁 Project Structure

```text
app/
├── Filament/Resources/    # Admin panel resources
├── Http/Controllers/     # Application controllers
├── Mail/                 # Email templates
└── Models/               # Eloquent models

resources/
├── views/                # Blade templates
├── css/                  # Stylesheets
└── lang/                 # Translation files

routes/
└── web.php               # Application routes
```

## 🔑 Key Functionality

-   **Product Variants:** Products can have multiple variants based on color and size combinations
-   **Stock Management:** Real-time stock tracking per variant
-   **Discount System:** Both product-level discounts and cart-wide discount codes
-   **Payment Processing:** Integrated with Mollie for secure payment handling
-   **Email Notifications:** Order confirmations sent to customers and admins
-   **Multi-language:** Support for multiple languages with Laravel Localization

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
