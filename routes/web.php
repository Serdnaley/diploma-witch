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

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('calendar');
})->name('home');

Route::get('/', 'CalendarController@index')
    ->name('calendar');

Route::get('/day/{day}', 'CalendarController@day')
    ->name('day');

Route::get('/disabled', function () {return view('disabled');})
    ->name('disabled');

Route::get('/users', 'UserController@index')
    ->name('user.index');

Route::post('/users/{user}/increment', 'UserController@increment')
    ->name('user.increment');

Route::resource('booking', 'BookingController');
