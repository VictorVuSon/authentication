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
///my router
/* Route::get('list-users',['as' => 'list-users','uses' => 'UserController@index']);
  Route::get('add-user',['as' => 'add-user','uses' => 'UserController@addForm']);
  Route::post('add-user',['as' => 'add-user','uses' => 'UserController@addAction']);
  Route::post('delete-user','UserController@delete');
  Route::get('edit-user/{id}',['as' => 'edit-user','uses' => 'UserController@editForm']);
  Route::post('edit-user/{id}','UserController@editAction');
  //categories management
  Route::get('list-cats',['as' => 'list-cats','uses' => 'CategoryController@index']);
  Route::get('add-cat',['as' => 'add-cat','uses' => 'CategoryController@addForm']);
  Route::get('edit-cat','CategoryController@index');
  Route::post('add-cat',['as' => 'add-cat','uses' => 'CategoryController@addAction']);
  Route::post('delete-cat','CategoryController@delete');
  Route::get('edit-cat/{id}',['as' => 'edit-cat','uses' => 'CategoryController@editForm']);
  Route::post('edit-cat/{id}',['as' => 'edit-cat-action','uses' => 'CategoryController@editAction']);


  //pages management
  Route::get('list-pages',['as' => 'list-pages','uses' => 'PageController@index']);
  Route::get('add-page',['as' => 'add-page','uses' => 'PageController@addForm']);
  Route::get('edit-page','PageController@index');
  Route::post('add-page',['as' => 'add-page-action','uses' => 'PageController@addAction']);
  Route::post('delete-page','PageController@delete');
  Route::get('edit-page/{id}',['as' => 'edit-page','uses' => 'PageController@editForm']);
  Route::post('edit-page/{id}',['as' => 'edit-page-action','uses' => 'PageController@editAction']);


  //food management
  Route::get('list-foods',['as' => 'list-foods','uses' => 'FoodController@index']);
  Route::get('add-food',['as' => 'add-food','uses' => 'FoodController@addForm']);
  Route::get('edit-food','FoodController@index');
  Route::post('add-food',['as' => 'add-food-action','uses' => 'FoodController@addAction']);
  Route::post('delete-food','FoodController@delete');
  Route::get('edit-food/{id}',['as' => 'edit-food','uses' => 'FoodController@editForm']);
  Route::post('edit-food/{id}',['as' => 'edit-food-action','uses' => 'FoodController@editAction']);





  Route::get('login', 'Auth\AuthController@getLogin');
  Route::post('login', 'Auth\AuthController@postLogin');
  Route::get('logout', 'Auth\AuthController@logout');

  // Registration Routes...
  Route::get('register', 'Auth\AuthController@getRegister');
  Route::post('register', 'Auth\AuthController@postRegister');

  // Password Reset Routes...
  Route::get('password/reset', 'Auth\PasswordController@getEmail');
  Route::post('password/email', 'Auth\PasswordController@postEmail');
  Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
  Route::post('password/reset', 'Auth\PasswordController@postReset');


 * */
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@logout');
Route::group(['middleware' => 'user'], function() {
    Route::get('/home', 'HomeController@index');
    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');
    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');
    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');
    Route::resource('foods', 'foodController');
});
Route::group(['middleware' => 'admin'], function() {
    Route::resource('users', 'userController');
    Route::get('user/getIndex','userController@getIndex')->name('user.getIndex');
    Route::resource('pages', 'pageController');
    Route::resource('categories', 'categoryController');
});
