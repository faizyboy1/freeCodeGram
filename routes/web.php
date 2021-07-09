<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowsController;
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

Route::get('/', [PostController::class, 'index']);

Auth::routes();
Route::post('/follow/{user}', [FollowsController::class, 'store']);

Route::get('/p/create', [PostController::class, 'create']);
Route::post('/p', [PostController::class, 'store']);
Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/p/{post}', [PostController::class, 'show']);
Route::get('profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
