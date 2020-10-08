# Laravel Backend User Management

## Release Notes

This is an initial release of my User Management Feature with Backend User API

## Prerequisites

- [node.js & npm](https://nodejs.org/)
- [laravel 8](http://laravel.com/)
- [laravel/ui](https://github.com/laravel/ui)
- [laravel http client](https://laravel.com/docs/8.x/http-client)

## Installation

1. Clone [this repository](git@gitlab.com:models/laravel-frontend-template.git) to a location on your file system.
2. `cd` into the directoy, run `npm install`.
3. Run `php artisan serve` to start the server.
4. Navigate to `localhost:8000` in your browser.

## Operation


### Modify CSS (Sass)

In order to work with the Sass files, you need to enable live compiling, in order to reflect your changes in the `.scss` files in `public/css/app.css`.

Start the live compiling with the `npm run watch` command, this will compile the Sass and also listen for changes and recompile whenever that happens.

In order to build a minified version of the CSS, run the `npm run build` command. This will do exactly the same as `npm run watch`, but it will output the `app.css` file as minified.
