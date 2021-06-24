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

Route::get('/', 'PagesController@home');
Route::get('/home', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');


Route::get('users/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('users/register', 'Auth\RegisterController@register');
Route::get('users/login', 'Auth\LoginController@showLoginForm');
Route::post('users/login', 'Auth\LoginController@login') -> name('login');
Route::get('users/logout', 'Auth\LoginController@logout');


Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'),
    function(){
        Route::get('/', 'PagesController@home');
        Route::get('users', 'UsersController@index');
        Route::get('users/{id?}/edit', 'UsersController@edit');
        Route::post('users/{id?}/edit', 'UsersController@update');
        
        Route::get('roles', 'RolesController@index');
        Route::get('roles/create','RolesController@create');
        Route::post('roles/create', 'RolesController@store');
        // Route::get('roles/{id?}/edit', 'RolesController@edit');
        // Route::post('roles/{id?}/edit', 'RolesController@update');
        // Route::post('roles/delete', 'RolesController@distroy');

        Route::get('posts', 'PostsController@index');
        Route::get('posts/create', 'PostsController@create');
        Route::post('posts/create', 'PostsController@store');
        Route::get('posts/{id?}/edit', 'PostsController@edit');
        Route::post('posts/{id?}/edit', 'PostsController@update');
        Route::get('posts/{id?}/delete', 'PostsController@destroy');


        Route::get('categories', 'CategoriesController@index');
        Route::get('categories/create', 'CategoriesController@create');
        Route::post('categories/create', 'CategoriesController@store');
    }
);

Route::get('/blog','BlogController@index');
Route::get('/blog/{slug?}', 'BlogController@show');
Route::group(array('middleware' => 'auth'),
    function(){
    Route::post('/blog/{slug?}', 'CommentsController@newComment');
});


