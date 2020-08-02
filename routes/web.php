<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin/products'], function(){
   Route::get('', 'ProductController@index')->name('product.index');
   Route::get('create', 'ProductController@create')->name('product.create');
   Route::post('store', 'ProductController@store')->name('product.store');
   Route::get('edit/{product}', 'ProductController@edit')->name('product.edit');
   Route::post('update/{product}', 'ProductController@update')->name('product.update');
   Route::post('delete/{product}', 'ProductController@destroy')->name('product.destroy');
   Route::get('show/{product}', 'ProductController@show')->name('product.show');
   // Route::post('delete/{image}', 'ImageController@destroy')->name('image.destroy');
});

 Route::group(['prefix' => 'admin/cats'], function(){
   Route::get('', 'CatController@index')->name('cat.index');
   Route::get('create', 'CatController@create')->name('cat.create');
   Route::post('store', 'CatController@store')->name('cat.store');
   Route::post('tagStore', 'CatController@tagStore')->name('tag.store');
   Route::get('edit/{cat}', 'CatController@edit')->name('cat.edit');
   Route::get('tag-edit/{tag}', 'CatController@tagEdit')->name('tag.edit');
   Route::post('update/{cat}', 'CatController@update')->name('cat.update');
   Route::post('tagUpdate/{tag}', 'CatController@tagUpdate')->name('tag.update');
   Route::post('delete/{cat}', 'CatController@destroy')->name('cat.destroy');
   Route::get('show/{cat}', 'CatController@show')->name('cat.show');
});

Route::get('/', 'FrontController@home')->name('front.home');
Route::post('add', 'FrontController@add')->name('front.add');
Route::post('add-js', 'FrontController@addJS')->name('front.add-js');
Route::post('remove', 'FrontController@remove')->name('front.remove');
Route::post('plus', 'FrontController@plus')->name('front.plus');
Route::post('minus', 'FrontController@minus')->name('front.minus');
Route::post('buy', 'FrontController@buy')->name('front.buy');

Route::get('all-good', 'FrontController@allGood')->name('all.good');
Route::get('paysera/accept', 'FrontController@payseraAccept')->name('paysera.accept');
Route::get('paysera/cancel', 'FrontController@payseraCancel')->name('paysera.cancel');

Route::post('paysera/callback', 'FrontController@payseraCallback')->name('paysera.callback');