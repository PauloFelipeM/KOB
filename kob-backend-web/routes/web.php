<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('select_workspace', 'HomeController@select_workspace')->name('select_workspace');
Route::get('signin_workspace/{id}', 'HomeController@signin_workspace');
Route::get('signout_workspace', 'HomeController@signout_workspace');

// Get cartype image
Route::middleware('auth')->get('/image/{filename}', function ($filename)
{    
    $path = Storage::disk('media')->getDriver()->getAdapter()->getPathPrefix() . $filename;    
    if(!File::exists($path)) abort(404);
    $file = File::get($path);
    $response = Response::make($file, 200);
    return $response;

})->name('service_type_image');

$router->group(['prefix' => 'service_types', 'middleware' => 'auth.access'], function () use ($router){
    $router->get('/', 'ServiceTypeController@index');
    $router->get('/view/{id}', 'ServiceTypeController@view');
    $router->get('/create', 'ServiceTypeController@create');
    $router->get('/update/{id}', 'ServiceTypeController@update');
    $router->post('/store/{id?}', 'ServiceTypeController@store');    
    $router->get('/delete/{service_type}', 'ServiceTypeController@delete');
});

$router->group(['prefix' => 'users', 'middleware' => 'auth'], function () use ($router){
    $router->get('/profile', 'UserController@my_profile');
    $router->post('/store', 'UserController@my_store');
});

$router->group(['prefix' => 'cards', 'middleware' => 'auth.access'], function () use ($router){
    $router->get('/{access_id}', 'CardController@index');
    $router->get('/view/{id}', 'CardController@view');    
    $router->get('/create/{access_id}', 'CardController@create');
    $router->get('/update/{id}', 'CardController@update');
    $router->post('/store/{id?}', 'CardController@store');    
    $router->get('/delete/{card}', 'CardController@delete');    
});

$router->group(['prefix' => 'tickets', 'middleware' => 'auth.access'], function () use ($router){
    $router->get('/', 'TicketController@index'); 
    $router->get('/create/{access_id}', 'TicketController@create');
    $router->get('/update/{id}/{access_id}', 'TicketController@update');
    $router->post('/store/{id?}', 'TicketController@store'); 
    $router->get('/delete/{ticket}', 'TicketController@delete');     
    $router->get('/start/{id}', 'TicketController@start');
    $router->get('/finish/{id}', 'TicketController@finish');
    $router->get('/calculate', 'TicketController@calculate_price');
});

$router->group(['prefix' => 'workspace_accesses', 'middleware' => 'auth.access'], function () use ($router){
    $router->get('/', 'WorkspaceAccessController@index');    
    $router->get('/create', 'WorkspaceAccessController@create');
    $router->get('/update/{id}', 'WorkspaceAccessController@update');
    $router->post('/store/{id?}', 'WorkspaceAccessController@store');    
});

$router->group(['prefix' => 'workspaces', 'middleware' => 'auth.admin'], function () use ($router){
    $router->get('/', 'WorkspaceController@index');
    $router->get('/view/{id}', 'WorkspaceController@view');
    $router->get('/create', 'WorkspaceController@create');
    $router->get('/update/{id}', 'WorkspaceController@update');
    $router->post('/store/{id?}', 'WorkspaceController@store');    
    $router->get('/delete/{workspace}', 'WorkspaceController@delete');
});

$router->group(['prefix' => 'accesses', 'middleware' => 'auth.admin'], function () use ($router){
    $router->get('/{workspace_id}', 'AccessController@index');
    $router->get('/create/{workspace_id}', 'AccessController@create');
    $router->get('/update/{id}', 'AccessController@update');
    $router->post('/store/{id?}', 'AccessController@store');    
});

$router->group(['prefix' => 'users', 'middleware' => 'auth.admin'], function () use ($router){
    $router->get('/', 'UserController@index');
    $router->get('/view/{id}', 'UserController@view');
    $router->get('/create', 'UserController@create');
    $router->get('/update/{id}', 'UserController@update');
    $router->post('/store/{id?}', 'UserController@store');    
    $router->get('/delete/{user}', 'UserController@delete');    
});
