<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', "HomeController@index")->name("index");

Route::get('/posts', "PostController@index")->name("posts.index");
Route::get('/posts/{slug}', "PostController@show")->name("posts.show");

// per admin, da fare ancora la distinzione
Route::prefix("admin")
    ->namespace("Admin")
    ->middleware("auth")
    ->name("admin.")
    ->group(function (){
        // posts
        Route::get("/posts/create", "PostController@create")->name("posts.create");
        Route::post("/posts", "PostController@store")->name("posts.store");
        Route::match(["PUT", "PATCH"], "/posts/{slug}", "PostController@update")->name("posts.update");
        Route::delete("/posts/{slug}", "PostController@destroy")->name("posts.destroy");
        Route::get("/posts/{slug}/edit", "PostController@edit")->name("posts.edit");
        // categories
        Route::get('/categories', "CategoryController@index")->name("categories.index");
        // tags
        Route::get('/tags', "TagController@index")->name("tags.index");
});


Auth::routes();

Route::get('/home', 'HomeController@dashboard')->name('home');
