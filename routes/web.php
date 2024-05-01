<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use Monolog\Handler\RotatingFileHandler;

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

Route::get('/', [MyController::class, 'fun_home'])->name('home');

Route::get('/login', [MyController::class, 'fun_login'])->name('login');
Route::post('/login', [MyController::class, 'post_login']) -> name('login.post');


Route::get('/signup', [MyController::class, 'fun_signup'])->name('signup');
Route::post('/signup',[MyController::class, 'post_signup'])->name('signup.post');


Route::get('/contact', [MyController::class,'fun_contact']) -> name('contact');


Route::get('/logout', [MyController::class,'logout']) ->name('logout');

Route::get('/userprofile', [MyController::class, 'fun_userprofile'])->name('userprofile');

Route::post('/userprofile', [MyController::class,'add_dish']) -> name('dishadd.post');

Route::get('/dish/{dishId}', [MyController::class, 'showDishFull']) -> name('dishcomplete');

Route::get('/recipes', [MyController::class, 'showAllRecipes']) ->name('allRecipes');

