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
            return view('home');
        } else if ($user->role == 'user') {
            return view('home');
        }
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories', 'CategoryController')->middleware('\App\Http\Middleware\AdminAuth');
