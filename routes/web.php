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

 /**Routing for Product Variations */
 
$router->group(['prefix' => 'productvariations'], function () use ($router) {
  
  $router->get('all',  ['uses' => 'ProductVariationController@get_all']);

  /**Note 
   * Get method requires the parent product id NOT the pimary id
   */
  $router->get('get/{id}', ['uses' => 'ProductVariationController@get']);

  $router->post('new', ['uses' => 'ProductVariationController@create']);

  $router->delete('delete/{id}', ['uses' => 'ProductVariationController@delete']);

  $router->put('update/{id}', ['uses' => 'ProductVariationController@update']);
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
  $router->get('all',  ['uses' => 'BranchController@get_all']);

  $router->get('get/{id}', ['uses' => 'BranchController@get']);

  $router->post('new', ['uses' => 'BranchController@create']);

  $router->delete('delete/{id}', ['uses' => 'BranchController@delete']);

  $router->put('update/{id}', ['uses' => 'BranchController@update']);
});

/**Routing for Branch Stock*/

$router->group(['prefix' => 'stock'], function () use ($router) {
  $router->get('all',  ['uses' => 'BranchStockController@get_all']);

  $router->get('get/{id}', ['uses' => 'BranchStockController@get']);

  $router->post('new', ['uses' => 'BranchStockController@create']);

  $router->delete('delete/{id}', ['uses' => 'BranchStockController@delete']);

  $router->put('update/{id}', ['uses' => 'BranchStockController@update']);
});

/**Routing for Staff */

$router->group(['prefix' => 'staff'], function () use ($router) {
  $router->get('all',  ['uses' => 'StaffController@get_all']);

  $router->get('get/{id}', ['uses' => 'StaffController@get']);

  $router->post('new', ['uses' => 'StaffController@create']);

  $router->delete('delete/{id}', ['uses' => 'StaffController@delete']);

  $router->put('update/{id}', ['uses' => 'StaffController@update']);
});
?>