<?php

use Illuminate\Support\Facades\Route;
use Dompdf\Dompdf;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/home','App\Http\Controllers\HomeController@home')->name('home'); // ila declanchat had lview khod la methode li hhayna f homeController
Route::get('/about','App\Http\Controllers\HomeController@about')->name('about');
Route::get('/names','App\Http\Controllers\usersController@names')->name('users.names');
Route::get('/login','App\Http\Controllers\usersController@login')->name('users.login');
Route::post('/login', 'App\Http\Controllers\usersController@authenticate')->name('users.submit');

Route::middleware('auth')->group(function () {
Route::get('/menu/{id}/details', 'App\Http\Controllers\CommandListController@menuDetails')->name('menu.details');
Route::post('/menu', 'App\Http\Controllers\MenuController@insertData')->name('menu.insertData');
Route::get('/printTicket', 'App\Http\Controllers\MenuController@printTicket')->name('printTicket');
Route::get('/menuId/{variable}', 'App\Http\Controllers\MenuController@menuId')->name('menuId');
Route::get('/printForClient', 'App\Http\Controllers\MenuController@printForClient')->name('printForClient');
Route::post('/insertPayment', 'App\Http\Controllers\MenuController@insertPayment')->name('insertPayment');
Route::get('/menu', 'App\Http\Controllers\MenuController@menu')->name('menu');
Route::get('/command', 'App\Http\Controllers\CommandListController@command')->name('command');
Route::get('/generatePdf', 'App\Http\Controllers\PdfController@generatePdf')->name('generatePdf');

});
//Route::post('/store', 'App\Http\Controllers\ClotureController@store')->name('store');

// Route::get('/cloture/create', 'App\Http\Controllers\ClotureController@create')->name('cloture.create');



Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/ajoutArticle','App\Http\Controllers\AjoutArticleController@index')->name('ajoutArticle');
    Route::get('/ajoutCategory','App\Http\Controllers\AjoutCategoryController@index')->name('ajoutCategory');
    Route::get('/admin', 'App\Http\Controllers\HomeController@admin')->name('admin');
    Route::post('/ajoutArticle', 'App\Http\Controllers\AjoutArticleController@store')->name('ajoutArticle.store');
    Route::post('/ajoutCategory', 'App\Http\Controllers\AjoutCategoryController@store')->name('ajoutCategory.store');
    Route::get('/add-sale', 'App\Http\Controllers\CommandListController@addSale')->name('add.sale');
    Route::post('/insertProduct', 'App\Http\Controllers\MenuController@insertProduct')->name('insertProduct');
    Route::resource('tables', 'App\Http\Controllers\TablesController');
    Route::put('tables/update/{table}', 'App\Http\Controllers\TablesController@update')->name('tables.update');
        
    Route::resource('products', 'App\Http\Controllers\MenuController');
    Route::put('products/update/{product}', 'App\Http\Controllers\MenuController@update')->name('products.update');

    Route::resource('categories', 'App\Http\Controllers\CategoryController');
    Route::put('categories/update/{category}', 'App\Http\Controllers\CategoryController@update')->name('categories.update');

    Route::resource('utilisateurs', 'App\Http\Controllers\UsersController');
    Route::put('utilisateurs/update/{user}', 'App\Http\Controllers\UsersController@update')->name('utilisateurs.update');

    Route::resource('clients', 'App\Http\Controllers\ClientsController');
    Route::put('clients/update/{client}', 'App\Http\Controllers\ClientsController@update')->name('clients.update');

    //reports
    Route::get('reports', 'App\Http\Controllers\ReportController@index')->name("reports.index");
    Route::post('reports/generate', 'App\Http\Controllers\ReportController@generate')->name("reports.generate");
    Route::post('reports/export', 'App\Http\Controllers\ReportController@export')->name("reports.export");

    Route::get('cloture', 'App\Http\Controllers\ClotureController@index')->name('cloture');
    Route::post('/cloture/store', 'App\Http\Controllers\ClotureController@store')->name('cloture.store');
    Route::get('/commandList', 'App\Http\Controllers\CommandListController@commandList')->name('commandList');


});

