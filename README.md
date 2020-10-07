# Laravel Backend User Management

## Prerequisites

- [node.js & npm](https://nodejs.org/)
- [laravel](http://laravel.com/)

## Installation

1. Clone [this repository](git@gitlab.com:models/laravel-frontend-template.git) to a location on your file system.
2. `cd` into the directoy, run `npm install`.
3. Run `php artisan serve` to start the server.
4. Navigate to `localhost:8000` in your browser.

## Operation

### Folders of Interest

During the frontend development phase, pretty much the only folders of interest will be the following:

```
resources/
  assets/
  dev/
  views/
    frontend/
```

### Add New Page

**Navigate to `resources/dev/pages.json` and add the page**

The structure is as follows:

```
[
  {
    // page
  },
  {
    // page
  }
]
```

Each object in the array represents individual pages. To add a new static one (one without data sent to it) we need to add at least a `path`, `file` and `title`.

```
{
  "path": "/contact",
  "file": "contact",
  "title": "Contact Us"
}
```

This code will ensure that requests to the path */contact* is caught and served with the *contact* file, and that the view file will receive *Contact Us* as it's title.

In order to add a page that dynamically handles content, e.g. a product page, you can also add a `data` attribute to the page, like this:

```
{
"path": "/products",
"file": "products",
"title": "Products",
"data": {
  "products": [
    {
      "name": "Product 1"
    },
    {
      "name": "Product 2"
    }
  ]
}
```

This will make the *product* available to the view, which can be looped through to produce a product list. Feel free to add as many properties as you like to each *products object*.

-----

**Navigate to `resources/views/frontend/` and add the new file**

When adding the new page to the `pages.json` file, you specified a filename. You'll now create this page with a `.blade.php` extension. This will give the file access to functionality provided by Laravel's template engine; *Blade*.

Blade allows you to use variables, loops etc directly in your view files, and each function can be [read about here](http://laravel.com/docs/5.0/templates).

In order to avoid having to copy and paste reusable content to each new page you create, a view can extend a layout file, and provide contents to different placeholders within that file. Here's an example of a *contact page* extending the *default layout*.

*default.blade.php* (layout file)
```
<html>
  <head>
    .. head stuff ..
  </head>
  <body>
    @yield("content")
  </body>
</html>
```

*contact.blade.php* (contact page file)
```
@extends("layouts.default")

@section("content")

<h1>Contact Page</h1>
<p>Fill in your contact information below</p>

<form>
  <input type="text" name="email">
  <button type="submit">Send</button>
</form>

@stop
```

### Modify CSS (Sass)

In order to work with the Sass files, you need to enable live compiling, in order to reflect your changes in the `.scss` files in `public/css/app.css`.

Start the live compiling with the `npm run watch` command, this will compile the Sass and also listen for changes and recompile whenever that happens.

In order to build a minified version of the CSS, run the `npm run build` command. This will do exactly the same as `npm run watch`, but it will output the `app.css` file as minified.
