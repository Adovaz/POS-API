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

/**Routing for products */

$router->group(['prefix' => 'products'], function () use ($router) {
  $router->get('all',  ['uses' => '']);

  $router->get('get/{id}', ['uses' => '']);

  $router->post('new', ['uses' => '']);

  $router->delete('delete/{id}', ['uses' => '']);

  $router->put('update/{id}', ['uses' => '']);
});

$router->group(['prefix' => 'suppliers'], function () use ($router) {
  $router->get('all',  ['uses' => '']);

  $router->get('get/{id}', ['uses' => '']);

  $router->post('new', ['uses' => '']);

  $router->delete('delete/{id}', ['uses' => '']);

  $router->put('update/{id}', ['uses' => '']);
});

$router->group(['prefix' => 'branches'], function () use ($router) {
  $router->get('all',  ['uses' => '']);

  $router->get('get/{id}', ['uses' => '']);

  $router->post('new', ['uses' => '']);

  $router->delete('delete/{id}', ['uses' => '']);

  $router->put('update/{id}', ['uses' => '']);
});
?>