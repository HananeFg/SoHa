<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home','App\Http\Controllers\HomeController@home')->name('home'); // ila declanchat had lview khod la methode li hhayna f homeController
Route::get('/about','App\Http\Controllers\HomeController@about')->name('about');
Route::get('/ajoutArticle','App\Http\Controllers\AjoutArticleController@index')->name('ajoutArticle');
Route::get('/users','App\Http\Controllers\usersController@index')->name('users.index');
Route::get('/login','App\Http\Controllers\usersController@login')->name('users.login');
Route::post('/login', 'App\Http\Controllers\usersController@authenticate')->name('users.submit');

Route::get('/posts/{id}/{author?}', 'App\Http\Controllers\HomeController@blog')->name('blog-post');