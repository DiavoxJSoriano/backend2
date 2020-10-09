# Laravel Backend User Management

## Release Notes

This is an initial release of my User Management Feature with Backend User API.

## Prerequisites

- [laravel 8](http://laravel.com/)
- [php 7.3](https://www.php.net/downloads.php) 
- [composer](https://getcomposer.org/download/)
- [node.js & npm](https://nodejs.org/)
- [laravel/ui](https://github.com/laravel/ui)
- [tinker](https://laravel.com/docs/8.x/artisan#tinker)
- [jquery](https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js)

## CRUD Operations

- User API resource CRUD operations are listed below which can be found in UserController:

```
| GET|HEAD  | api/user               | user.index       | App\Http\Controllers\UserController@index
| POST      | api/user               | user.store       | App\Http\Controllers\UserController@store
| GET|HEAD  | api/user/{user}        | user.show        | App\Http\Controllers\UserController@show
| PUT|PATCH | api/user/{user}        | user.update      | App\Http\Controllers\UserController@update
| DELETE    | api/user/{user}        | user.destroy     | App\Http\Controllers\UserController@destroy
| POST      | api/delete-users       | user.destruct    | App\Http\Controllers\UserController@destroyMany
```

## Installation

1. Clone [this repository](https://github.com/DiavoxJSoriano/backend2.git) to a location on your file system.
2. `cd` into the directoy.
4. run `composer install`
5. run `npm install`
6. Run `php artisan serve` to start the server and perform initial testing.
7. Navigate to `localhost:8000` in your browser.

## Configuration

1. Copy the .env.example file to .env `copy .env.example .env`
2. Generate application key. Run `php artisan key:generate`
3. Create an empty database in your MySQL database. This application was tested on MySQL 5 version. There might be conflict still needed to be resolved on a MySQL 8.
4. Update your database configurations below:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=backend
DB_USERNAME=root
DB_PASSWORD=<your-password>
```

## Data Migration

- Run `php artisan migrate` to initially create migrate database structure.
- Run `php artisan tinker` to open Psy Shell
- Execute command `User::factory()->count(50)->create();` to populate 50 random test users. You may change the count(value) to the number of records you wish to test. Re-run this code will truncate the table and re-create new sets of users.
- In case of duplicate key error. Execute the command again.

## Application Views

- Registration
!(https://github.com/DiavoxJSoriano/backend2/blob/main/images/SS-Registration.PNG)

- Successful Registration redirects to Dashboard
!(https://github.com/DiavoxJSoriano/backend2/blob/main/images/SS-AfterRegistration.PNG)

- Go to User Management view
!(https://github.com/DiavoxJSoriano/backend2/blob/main/images/SS-UserManagementPage.PNG)

- Add a new user
!(https://github.com/DiavoxJSoriano/backend2/blob/main/images/SS-AddNewUser.PNG)

- Edit a user profile
!(https://github.com/DiavoxJSoriano/backend2/blob/main/images/SS-EditProfile.PNG)

- Multiple selection and deletion
!(https://github.com/DiavoxJSoriano/backend2/blob/main/images/SS-MultipleSelectAndDelete.PNG)




