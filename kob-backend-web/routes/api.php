<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Setup CORS */
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST");

Route::post('access', 'Api\AuthController@access_code');
Route::post('login', 'Api\AuthController@login');
Route::middleware('auth:api')->post('logout', 'Api\AuthController@logout');
Route::post('access/socials', 'Api\AuthController@socials_login');
Route::post('register', 'Api\AuthController@register');

Route::middleware('auth:api')->get('states', 'Api\AddressesController@states');
Route::middleware('auth:api')->get('countries', 'Api\AddressesController@countries');

$router->group(['prefix' => 'users','middleware' => 'auth:api'], function () use ($router) {        
    $router->get('/', 'Api\UserController@index');
});

$router->group(['prefix' => 'cards','middleware' => 'auth:api'], function () use ($router) {        
    $router->get('/', 'Api\CardController@index');
    $router->post('/create', 'Api\CardController@create');
    $router->post('/delete/{card}', 'Api\CardController@delete');
});

$router->group(['prefix' => 'cartypes','middleware' => 'auth:api'], function () use ($router) {        
    $router->get('/', 'Api\CarTypeController@index');
});

$router->group(['prefix' => 'tickets','middleware' => 'auth:api'], function () use ($router) {        
    $router->get('/', 'Api\TicketController@index');
    $router->get('/calculate/price', 'Api\TicketController@calculate_price');
    $router->post('/create', 'Api\TicketController@create');
});