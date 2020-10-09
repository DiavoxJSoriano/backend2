# Laravel Backend User Management

## Release Notes

This is an initial release of my User Management Feature with Backend User API.

## Prerequisites

- [node.js & npm](https://nodejs.org/)
- [laravel 8](http://laravel.com/)
- [laravel/ui](https://github.com/laravel/ui)
- [jquery](https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js)


## Installation

1. Clone [this repository](git@gitlab.com:models/laravel-frontend-template.git) to a location on your file system.
2. `cd` into the directoy, run `npm install`.
3. Run `php artisan serve` to start the server.
4. Navigate to `localhost:8000` in your browser.

## Data Migration

Run `php artisan serve` to initially create migrate database structure.
Run `php artisan tinker` to open Psy Shell
Execute command `User::factory()->count(50)->create();` to populate 50 random test users. You may change the count(value) to the number of records you wish to test. Re-run this code will truncate the table and re-create new sets of users.


