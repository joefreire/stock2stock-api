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
    return 'Hello Stock2Stock test';
});

$router->group(['prefix' => 'products'], function () use ($router) {
  $router->get('/',  ['uses' => 'ProductController@showAll']);

  $router->get('/{sku}', ['uses' => 'ProductController@showOne']);

  $router->post('/', ['uses' => 'ProductController@create']);

  $router->delete('/{sku}', ['uses' => 'ProductController@delete']);

  $router->put('/{sku}', ['uses' => 'ProductController@update']);
});