<p align="center">
    <h1 align="center">Toko Laravel</h1>
</p>

## Installation

### Clone Repository

    https://github.com/HoldenTingson/toko_laravel.git

### Install Dependencies

    cd YourDirectory
    composer install

### Config File

Run `php artisan key:generate` to generate app key.

1. Set your database credentials in `.env` file
1. Set your `APP_URL` in `.env` file.

### Database

1. Migrate database table `php artisan migrate`
1. `php artisan db:seed`, this will create a new admin(email: admin@gmail.com, password: admin123)

### Install Node Dependencies

1. `npm install`

### Create Storage Link

`php artisan storage:link`

### Run Server and View

1. `php artisan serve`
2. `npm run dev`
3. Login with Email: `admin@gmail.com`, Password: `admin123`.
