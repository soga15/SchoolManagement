<?php

use App\Http\Controllers\UserController;
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


Route::get('{path}', function(){
    return view('app');
})->where('path', "([A-z\d\-/_.]+)?" );


// Route::get('/home', [UserController::class, 'index'] );


// Route::get('/', function () {
//     return view('welcome' );
// });


// Route::get('/content', function () {
//     return view('content');
// });

// Route::get('/contact', function () {
//     return view('contact');
// });

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('register');
// });




