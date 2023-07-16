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

Route::get('/', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    if ($user) {
        if ($user->role == 'admin') {
            return redirect(route('categories.index'));
        } else if ($user->role == 'user') {
            return redirect(route('books.index'));
        }
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories', 'CategoryController')->middleware('\App\Http\Middleware\AdminAuth');
Route::resource('authors', 'AuthorController')->middleware('\App\Http\Middleware\AdminAuth');
Route::resource('publishers', 'PublisherController')->middleware('\App\Http\Middleware\AdminAuth');

// Books
Route::get('books', 'BookController@index')->name('books.index');
Route::get('books/new', 'BookController@create')->name('books.create');
Route::post('books', 'BookController@store')->name('books.store');
Route::put('books/{id}', 'BookController@update')->name('books.update');
Route::get('books/{id}', 'BookController@show')->name('books.show');
Route::get('books/{id}/update', 'BookController@edit')->name('books.edit');
Route::delete('books/{id}', 'BookController@destroy')->name('books.destroy');
