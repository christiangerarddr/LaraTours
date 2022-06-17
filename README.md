# LaraTours

## Features

-   Laravel 9
-   Vue + VueRouter + Vuex
-   Login, register, update profile
-   password reset
-   Authentication with Sanctum
-   Tailwind + Heroicons

## Main Functions

-   List all “Public” tours
-   Edit a tour
-   Create a tour
-   Make a booking for a “Public” tour, and can only booking a “Enabled” tour date
-   Edit a booking and allow user to add/remove passenger in this booking

## Installation

-   `cp .env.example .env`
-   on your `.env`, set your database connection details and app_url
-   `composer install`
-   `php artisan migrate`
-   `php artisan key:gen`
-   `npm install`
-   `npm run dev`

#### Development

```bash
npm run watch

```
