<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
  $router->get('all_products',  ['uses' => 'productController@getAllProducts']);

  $router->get('product/{id}', ['uses' => 'productController@getProduct']);

  $router->post('product', ['uses' => 'productController@create']);

  $router->delete('product/{id}', ['uses' => 'productController@delete']);

  $router->put('product/{id}', ['uses' => 'productController@update']);
});

?>