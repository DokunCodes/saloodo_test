<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () {
    return response(file_get_contents(__DIR__ . '/../readme.md'))
            ->header('Content-Type', 'text/plain');
});



$router->group(['prefix' => 'api/v1'], function ($router) {

    /**
     * Authentication
     */
    $router->post('login', 'AuthController@login');
    $router->post('register', 'AuthController@register');

    /**
     * Admin Activities
     */
    $router->group(['prefix' => 'product'], function ($router) {
        $router->post('add', 'AdminController@addProduct');
    });

    $router->group(['prefix' => 'bundle'], function ($router) {
        $router->post('create', 'AdminController@createBundle');
    });

    /**
     * Customer Activities
     */

    $router->group(['prefix' => 'product'], function ($router) {
        $router->get('get', 'ProductController@getProduct');
    });

    $router->group(['prefix' => 'order'], function ($router) {
        $router->post('place', 'CustomerController@placeOrder');
        $router->post('list', 'CustomerController@listOrder');


    });




});
