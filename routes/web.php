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

//Route::get('/', function () {
//    return view('welcome');
//});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/welcome/{mid}', function ($mid) {
//    return 'welcome '.$mid;
//});
//Route::get('/about', function () {
//    return view('pages.about');
//});

Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/sating','PagesController@services');

Route::get('post/likesm/{id}', ['as' => 'post.likesm', 'uses' => 'PostController@likesm']);
Route::get('post/likes/{id}', ['as' => 'post.likes', 'uses' => 'PostController@likes']);
Route::resource('post','PostController');

//comments
Route::post('/comments', ['as' => 'comments.store', 'uses' => 'CommentsController@store']);
//!comments

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');



