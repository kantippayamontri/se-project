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


//------test-----
Route::get('/user', function () {
    return view('user.index');
});

//register
Route::post('/register/store', 'Auth\RegisterController@store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//user
Route::delete('/user/delete/{id}', 'HomeController@destroy');
Route::get('/user', 'HomeController@index_for_page');

//product

Route::get('/product', 'ProductController@index');

Route::get('/product/add', 'ProductController@create');
Route::post('/product/store', 'ProductController@store');

Route::delete('/product/delete/{id}', 'ProductController@destroy');
Route::get('/product/edit/{id}', 'ProductController@edit');
Route::patch('/product/update/{id}','ProductController@update');


//Route for normal user
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
});
//Route for admin
Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => ['admin']], function(){
        Route::get('/dashboard', 'admin\AdminController@index');
    });
});
