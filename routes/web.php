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

Route::get('/about', ['middleware' => 'auth', 'users' => 'PagesController@about']);

Route::get('/contact', ['middleware' => 'auth', function()
{
    return 'This page shown only for singed users';
}]);

// Route::get('/articles', 'ArticlesController@index');
// Route::get('/articles/create', 'ArticlesController@create');
// Route::get('/articles/{id}', 'ArticlesController@show');
// Route::post('/articles', 'ArticlesController@store');
// Route::get('/articles/{id}/edit', 'ArticlesController@edit');
Route::resource('articles', 'ArticlesController');

// Route::controller([
//     'auth'      => 'Auth\AuthController',
//     'password'  => 'Auth\PasswordController',
// ]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/foo', ['middleware' => 'manager', function()
{
    return 'only manager can see it';
}]);
