<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
//'middleware' => 'admin'
////
//Route::get('/error', function() {
//    abort(404);
//});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index');
Route::auth();

//Route::resource();
/*
  |--------------------------------------------------------------------------
  | API routes
  |--------------------------------------------------------------------------
 */

Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});


// Registration Routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Password Reset Routes...
Route::get('password/reset', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@logout');
Route::group(['middleware' => 'user'], function() {
    Route::get('/home', 'HomeController@index');
    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');
    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');
    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');
    Route::resource('foods', 'foodController');
    Route::get('food/getIndex', 'foodController@getIndex')->name('food.getIndex');
});
Route::group(['middleware' => 'admin'], function() {
    Route::resource('users', 'userController');
    Route::get('user/getIndex', 'userController@getIndex')->name('user.getIndex');
    Route::resource('pages', 'pageController');
    Route::resource('categories', 'CategoryController');
    Route::get('category/getIndex', 'CategoryController@getIndex')->name('category.getIndex');
});
