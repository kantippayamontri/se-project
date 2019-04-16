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

//out of stock
Route::get('/out_of_stock/store/{id}', 'Out_of_stockController@store');
Route::delete('/out_of_stock/delete/{id}', 'Out_of_stockController@destroy');
Route::patch('/out_of_stock/update/{id}','Out_of_stockController@update');
Route::get('/out_of_stock/edit/{id}', 'Out_of_stockController@edit');
Route::get('/out_of_stock', 'Out_of_stockController@index');
Route::get('/out_of_stock/tell/{id}', 'Out_of_stockController@tell')->name('out_of_stock.tell');


//vote
Route::get('/vote/addtoproduct/{id}', 'VoteController@add_to_product')->name('vote.addtoproduct');
Route::get('/vote/vote/{id}', 'VoteController@vote_')->name('vote.vote');
Route::delete('/vote/delete/{id}', 'VoteController@destroy');
Route::get('/vote', 'VoteController@index')->name('vote.index');
Route::patch('/vote/update/{id}','VoteController@update');
Route::get('/vote/edit/{id}', 'VoteController@edit')->name('vote.edit');
Route::post('/vote/store', 'VoteController@store');
Route::get('/vote/add', function () {
    return view('vote.add');
});

//coupon
Route::get('/coupon/store/{id}', 'CouponController@store')->name('coupon.store');
Route::post('/coupon/check/{total}', 'CouponController@check')->name('coupon.check');

//promotion
Route::patch('/promotion/update/{id}','PromotionController@update');
Route::get('/promotion/edit/{id}', 'PromotionController@edit')->name('promotion.edit');
Route::get('/promotion', 'PromotionController@index')->name('promotion.index');
Route::post('/promotion/store', 'PromotionController@store');
Route::get('/promotion/add', function () {
    return view('promotion.addpromotion');
});
Route::get('/promotion/delete/{id}' , 'PromotionController@destroy')->name('promotion.delete');

//history
Route::get('/history/store/{total_price}/{total_point}/{coupon_id}', 'HistoryController@store');
//cart
Route::patch('/cart/plus/{id}','CartController@plus');
Route::patch('/cart/minus/{id}','CartController@minus');
Route::delete('/cart/delete/{id}', 'CartController@destroy');
Route::get('/cart', 'CartController@index')->name('cart');;
Route::post('/cart/store/{id}', 'CartController@store');

Route::get('/', function () {
    return view('welcome');
});


//------test-----
 Route::get('/user/edit', function () {
     return view('user.edit');
 });

//register
Route::post('/register/store', 'Auth\RegisterController@store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//user
Route::get('/user/profile', 'HomeController@profile')->name('profile');
Route::get('/user/edit/{id}', 'HomeController@edit');
Route::delete('/user/delete/{id}', 'HomeController@destroy');
Route::get('/user', 'HomeController@index_for_page');
Route::patch('/user/update/{id}','HomeController@update');

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
