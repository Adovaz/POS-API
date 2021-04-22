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

/**Routing for Products */

$router->group(['prefix' => 'products'], function () use ($router) {
  $router->get('all',  ['uses' => 'ProductController@get_all']);

  $router->get('get/{id}', ['uses' => 'ProductController@get']);

  $router->post('new', ['uses' => 'ProductController@create']);

  $router->delete('delete/{id}', ['uses' => 'ProductController@delete']);

  $router->put('update/{id}', ['uses' => 'ProductController@update']);
});

/**Routing for Product Categories */

$router->group(['prefix' => 'productcategories'], function () use ($router) {
  $router->get('all',  ['uses' => 'ProductCategoryController@get_all']);

  $router->get('get/{id}', ['uses' => 'ProductCategoryController@get']);

  $router->post('new', ['uses' => 'ProductCategoryController@create']);

  $router->delete('delete/{id}', ['uses' => 'ProductCategoryController@delete']);

  $router->put('update/{id}', ['uses' => 'ProductCategoryController@update']);
});

/**Routing for Suppliers */

$router->group(['prefix' => 'suppliers'], function () use ($router) {
  $router->get('all',  ['uses' => 'SupplierController@get_all']);

  $router->get('get/{id}', ['uses' => 'SupplierController@get']);

  $router->post('new', ['uses' => 'SupplierController@create']);

  $router->delete('delete/{id}', ['uses' => 'SupplierController@delete']);

  $router->put('update/{id}', ['uses' => 'SupplierController@update']);
});

/**Routing for Branches */

$router->group(['prefix' => 'branches'], function () use ($router) {
  $router->get('all',  ['uses' => '']);

  $router->get('get/{id}', ['uses' => '']);

  $router->post('new', ['uses' => '']);

  $router->delete('delete/{id}', ['uses' => '']);

  $router->put('update/{id}', ['uses' => '']);
});
?>