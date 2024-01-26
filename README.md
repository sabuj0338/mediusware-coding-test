# Installation

## Please install required dependencies that laravel application depends on.

### Laravel current version is "laravel/framework": "^10.10"

1. Clone this repository and go to project directory
2. Then run this command to install composer packages
```bash
$ composer install
```
3. Then install node modules
```bash
$ npm install
$ npm run dev
```
4. Then copy .env.example file to .env

5. Edit .env file give the mysql database name, user, and password
6. Then migrate and seed database tables
```bash
$ php artisan migrate
```
7. Then finally run the application and open it default link: http://localhost:8000
```bash
$ php artisan serve
```