## Installation and Running

- Clone this repository
- Open your terminal and CD into the root of the directory
- Run `cp .example.env .env`
- Set your `DB_CONNECTION` and `CACHE_DRIVER` of choice by default they will be `sqlite` and `redis` 
- Run `composer install` in the terminal
- Run migrations `php artisan migrate` in the terminal
- Serve application locally `php artisan serve` in the terminal
- You can use any API Client (like Postman) of choice to test the application.
- Run tests `./vendor/bin/phpunit` in the terminal

## API Routes

### Store a City

This will store a secret into the database given the provided parameters.

Endpoint: `POST api/cities`

Parameters:
- `name` - `required` - Name of a City.

### Retrieve Cities (with 5 Day 3 Hour Forecast)
Endpoint: `GET api/cities`
