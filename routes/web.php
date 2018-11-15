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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware'=>'auth'], function(){
  	// show product
	Route::get('/products','ProductController@index');
	// alternative route laravel crud product
	Route::resource('product', 'ProductController');

	// show kategori
	Route::get('/categories','CategoryController@index');
	// alternative route laravel crud category
	Route::resource('category', 'CategoryController');
});

// Routing Customer
Route::get('/','ProductController@customer');


// Routing Admin //
Route::get('/dashboard', function () {
    return view('pages-admin.home');
});

// create product
Route::get('/add-product','ProductController@create');

// ROUTE CRUD MANUAL UNTUK PRODUCT
// // save product
// Route::post('/product','ProductController@store');

// // edit product
// Route::get('/products/{id}/edit','ProductController@edit');
// Route::put('/products/{id}','ProductController@update');

// // hapus product
// Route::delete('/products/{id}','ProductController@destroy');

// ROUTE CRUD MANUAL UNTUK CATEGORY
// create category
Route::get('/add-category','CategoryController@create');

// save category
// Route::post('/category','CategoryController@store');

// // edit category
// Route::get('/category/{id}/edit','CategoryController@edit');
// Route::put('/category/{id}','CategoryController@update');

// // hapus category
// Route::delete('/category/{id}','CategoryController@destroy');


//cari data produk Backend
Route::post('/cari-produk','ProductController@CariDataProduk');

//cari data produk frontend
Route::get('/filter-produk','ProductController@FilterDataProduk');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
