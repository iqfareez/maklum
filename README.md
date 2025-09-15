<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://github.com/user-attachments/assets/8cee6fb9-19a4-4ca4-aedd-7a17ec407500" width="400" alt="Maklum Logo"></a></p>

# Maklum

Maklum is a lightweight feedback management API built with Laravel. It lets other applications register and send user feedback to a central service where feedback can be viewed, searched, and managed.

Visit demo site here: **https://maklum-demo.iqfareez.com**

_Demo username / password: `admin@example.com` / `pisang123`_

## Features

-   Receive feedback from external apps via API
-   List, view, and filter feedback entries
-   Receive email notifications for new feedback received (bring your own key)

## Getting Started

These steps assume a you have Laravel development environment ready.

1.  Clone the repository
2.  Install dependencies

    ```bash
    composer install
    npm install
    ```

3.  Setup `.env` file
    ```bash
    cp .env.example .env
    ```
4.  Generate application key

    ```bash
    php artisan key:generate
    ```

5.  Configure database in `.env` file (DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD)
6.  Run migrations and seeders

    ```bash
    php artisan migrate
    php artisan db:seed --class=FeedbackSeeder
    ```

7.  Start the development server

    ```bash
    composer run dev
    ```

8.  Visit Admin Panel at `http://127.0.0.1:8000/admin`

## Authentication

The admin panel requires authentication. You can create a user using this command:

```bash
php artisan make:filament-user
```

Then, login using the credentials you've just created.

## API Overview

todo
