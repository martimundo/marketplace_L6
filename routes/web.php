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
//use Illuminate\Routing\Route;


//######## FRONT END

use Illuminate\Http\Request;


Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');

//view product for category
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/{slug}', 'StoreController@index')->name('store.index');

Route::prefix('cart')->name('cart.')->group(function(){

    Route::get('/', 'CartController@index')->name('index');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');    
    Route::post('add', 'CartController@add')->name('add');

});

//Rotas para o CHECKOUT
Route::prefix('checkout')->name('checkout.')->group(function(){

    Route::get('/','CheckoutController@index')->name('index');
    Route::post('/proccess','CheckoutController@proccess' )->name('proccess');
    Route::get('/tanks', 'CheckoutController@tanks')->name('tanks');
});




//########ROTAS ADMINISTRATIVA
Route::group(['middleware'=>'auth'], function(){

    Route::get('my-orders', 'UserOrderController@index')->name('my.orders');

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){

        // Route::prefix('stores')->name('stores.')->group(function(){
    
        //     Route::get('/', 'StoreController@index')->name('index');
        //     Route::get('/create', 'StoreController@create')->name('create');
        //     Route::post('/store','StoreController@store')->name('store');
        //     Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
        //     Route::post('/update/{store}', 'StoreController@update')->name('update');
        //     Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
    
        // });
        Route::resource('stores', 'StoreController');
        Route::resource('categories', 'CategoryController');
        Route::resource('products','ProductController');

        Route::post('photos/remove','ProductPhotoController@removePhoto')->name('photo.remove');

        Route::get('orders/my', 'OrdersController@index')->name('orders.my');
        
    });
});



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
