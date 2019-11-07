# !Rest API using LUMEN For Saloodo


This codebase was created to demonstrate a fully functional REST API built with **Lumen + MySQL**, using JWT authentication.


# Getting started

## Installation

Please check the official Lumen installation guide for server requirements before you start. [Official Documentation](https://lumen.laravel.com/docs)


Clone the repository

    git clone https://github.com/DokunCodes/saloodo_test.git

Switch to the repo folder

    cd saloodo_rest

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

Since Lumen doesn't have the `php artisan key:generate` command.

Generate a new JWT authentication secret key

    php artisan jwt:secret

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php -S localhost:8000 -t public

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@elcobvg/lumen-realworld-example-app.git
    cd lumen-realworld-example-app
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan jwt:secret 
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php -S localhost:8000 -t public

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh


## Dependencies

- MySQL DB
- [jwt-auth](https://github.com/tymondesigns/jwt-auth) - For authentication using JSON Web Tokens
- [laravel-cors](https://github.com/barryvdh/laravel-cors) - For handling Cross-Origin Resource Sharing (CORS)

## Folders

- `app/Models` - Contains all the Eloquent models
- `app/Http/Controllers` - Contains all the api controllers
- `app/Http/Middleware` - Contains the JWT auth middleware
- `app/Providers` - Contains the JWT auth service provider
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the api routes defined in web.php file



## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the Lumen development server

    php -S localhost:8000 -t public

The api can now be accessed at

    1. http://localhost:8000/api/v1
    1. Create an account (http://localhost:8000/api/v1/register) as admin or customer to use
    2. Check route file routes/web.php for endpoints & controller

Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Yes      	| X-Requested-With 	| XMLHttpRequest   	|
| Optional 	| Authorization    	| Token {JWT}      	|


----------
 
# Authentication
 
This applications uses JSON Web Token (JWT) to handle authentication. The token is passed with each request using the `Authorization` header with `Token` scheme. The JWT authentication middleware handles the validation and authentication of the token. Please check the following sources to learn more about JWT.
 
- https://jwt.io/introduction/
- https://self-issued.info/docs/draft-ietf-oauth-json-web-token.html

----------

# Cross-Origin Resource Sharing (CORS)
 
This applications has CORS enabled by default on all API endpoints. The CORS allowed origins can be changed by setting them in the config file. Please check the following sources to learn more about CORS.
 
- https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
- https://en.wikipedia.org/wiki/Cross-origin_resource_sharing
- https://www.w3.org/TR/cors
