# NexaMart E-commerce Application

NexaMart is a comprehensive e-commerce platform built using Laravel 11. It offers a robust and scalable solution for setting up an online store, providing features like product management, user authentication, order processing, and payment integration.

## Features

- **User Authentication:** Secure login and registration with email verification.
- **Product Management:** Admin dashboard for adding, updating, and deleting products.
- **Shopping Cart:** Add products to the cart, update quantities, and proceed to checkout.
- **Order Management:** Track orders from the admin panel, including order status and payment details.
- **Payment Integration:** Supports payment gateways like Stripe, PayPal, and others.
- **Responsive Design:** Optimized for both desktop and mobile devices.
- **Search & Filter:** Powerful search and filter options to find products quickly.
- **User Reviews & Ratings:** Customers can leave reviews and ratings for products.

## Installation

### Prerequisites

- PHP >= 8.1
- Composer
- NPM
- MySQL or any other compatible database

### Steps

1. **Clone the repository:**
    ```bash
    git clone https://github.com/imtyaz-17/nexa-mart-ecommerce-laravel.git
    cd nexamart
    ```

2. **Install dependencies:**
    ```bash
    composer install
    npm install
    npm run build
    ```

3. **Set up environment variables:**
    - Copy `.env.example` to `.env`
    - Update the database credentials and other necessary configurations.

    ```bash
    cp .env.example .env
    ```

4. **Generate application key:**
    ```bash
    php artisan key:generate
    ```

5. **Run migrations and seeders:**
    ```bash
    php artisan migrate --seed
    ```

6. **Serve the application:**
    ```bash
    php artisan serve
    ```

7. **Access the application:**
    - Open your browser and navigate to `http://localhost:8000`

## Routes Overview

The NexaMart application includes the following key routes:

- **Home & Shop:**
    - `/` - Home page
    - `/shop/{categorySlug?}/{subCategorySlug?}` - Browse products by category/subcategory
    - `/product/{slug}` - View product details

- **Shopping Cart:**
    - `/cart` - View shopping cart
    - `/checkout` - Checkout process (requires authentication)
    - `/thanks/{orderId}` - Thank you page after successful order

- **User Profile:**
    - `/profile` - View and edit user profile (requires authentication)
    - `/profile/edit` - Edit user profile information
    - `/profile` - Update user profile information
    - `/profile` - Delete user account

- **Admin Panel:**
    - `/admin/login` - Admin login
    - `/admin/dashboard` - Admin dashboard (requires admin authentication)
    - `/admin/categories` - Manage categories
    - `/admin/subcategories` - Manage subcategories
    - `/admin/brands` - Manage brands
    - `/admin/products` - Manage products
    - `/admin/shipping` - Manage shipping methods
    - `/admin/coupons` - Manage discount coupons

For a complete list of routes, refer to the `routes/web.php` file.

## Usage

- **Admin Panel:** Accessible via `/admin`. Use the credentials provided by the seeder or create a new admin user.
- **User Management:** Manage user roles and permissions from the admin panel.
- **Order Processing:** View, update, and manage orders in the admin panel.

## Contributing

We welcome contributions to improve NexaMart! Please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature`).
3. Commit your changes (`git commit -am 'Add new feature'`).
4. Push to the branch (`git push origin feature/your-feature`).
5. Open a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For any inquiries, please reach out to:

- **Email:** imtyazit17017@gmail.com
- **GitHub:** [imtyaz-17](https://github.com/imtyaz-17)
