<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

 
Route::resource('products','ProductController');
Route::get('products/soft/delete/{id}','ProductController@softDelete')->name('soft.delete');
Route::get('products/t/trash','ProductController@trashedProducts')->name('product.trash');
Route::get('products/back/fromSoftDelete/{id}','ProductController@backFromSoftDelete')->name('soft.back');
Route::get('product/delete/from/database/{id}', 'ProductController@deleteForEver')
->name('product.delete.from21.database');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//one to one realtion
//user ->profile
Route::get('/profile', 'ProfileControlle@index')->name('profile');
Route::put('/profile/update', 'ProfileControlle@update')->name('profile.update');

///one to many realtion T
//user ->posts
Route::get('/posts','PostController@index')->name('posts');
Route::get('/posts/trashed','PostController@postsTrashed')->name('posts.trashed');
Route::get('/post/create','PostController@create')->name('posts.create');
Route::post('/post/store','PostController@store')->name('posts.store');
Route::get('/post/show/{slug}','PostController@show')->name('posts.show');
Route::get('/posts/{id}','PostController@edit')->name('posts.edit');
Route::post('/post/update/{id}','PostController@update')->name('posts.update');
Route::get('/post/destroy/{id}','PostController@destroy')->name('posts.delete');
Route::get('/post/hdelete/{id}','PostController@hdelete')->name('posts.hdelete');
Route::get('/post/restore/{id}','PostController@restore')->name('posts.restore');


//many to many realtion
//post->tags
Route::get('/tags', 'TagController@index' )->name('tags');
Route::get('/tag/create', 'TagController@create' )->name('tag.create');
Route::post('/tag/store', 'TagController@store' )->name('tag.store');
Route::get('/tag/show/{slug}', 'TagController@show' )->name('tag.show');
Route::get('/tag/edit/{id}', 'TagController@edit' )->name('tag.edit');
Route::post('/tag/update/{id}', 'TagController@update' )->name('tag.update');
Route::get('/tag/destroy/{id}', 'TagController@destroy' )->name('tag.destroy');



//Routes for usersUser
//post->tags
Route::get('/users', 'UserController@index' )->name('users');
Route::get('/user/create', 'UserController@create' )->name('user.create');
Route::post('/user/store', 'UserController@store' )->name('user.store');
Route::get('/user/destroy/{id}', 'UserController@destroy' )->name('user.destroy');
