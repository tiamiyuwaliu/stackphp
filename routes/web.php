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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::any('/login', [\App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::any('/signup', [\App\Http\Controllers\HomeController::class, 'signup']);
Route::any('/logout', [\App\Http\Controllers\HomeController::class, 'logout']);


Route::any('/home', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth']);
Route::any('/account', [\App\Http\Controllers\DashboardController::class, 'account'])->middleware(['auth']);

/**
 * Admin panel routes
 */
Route::any('/cp', [\App\Http\Controllers\AdminController::class, 'index'])->middleware(['auth', 'admin']);
Route::any('/cp/users', [\App\Http\Controllers\AdminController::class, 'users'])->middleware(['auth', 'admin']);
Route::any('/cp/settings', [\App\Http\Controllers\AdminController::class, 'settings'])->middleware(['auth', 'admin']);
Route::any('/cp/settings/information', [\App\Http\Controllers\AdminController::class, 'settings'])->middleware(['auth', 'admin']);
Route::any('/cp/settings/email', [\App\Http\Controllers\AdminController::class, 'settings'])->middleware(['auth', 'admin']);
Route::any('/cp/settings/social', [\App\Http\Controllers\AdminController::class, 'settings'])->middleware(['auth', 'admin']);
Route::any('/cp/settings/upload', [\App\Http\Controllers\AdminController::class, 'settings'])->middleware(['auth', 'admin']);
Route::any('/cp/email', [\App\Http\Controllers\AdminController::class, 'email'])->middleware(['auth', 'admin']);
Route::any('/cp/modules', [\App\Http\Controllers\AdminController::class, 'modules'])->middleware(['auth', 'admin']);
Route::any('/cp/pages', [\App\Http\Controllers\AdminController::class, 'pages'])->middleware(['auth', 'admin']);
Route::any('/cp/themes', [\App\Http\Controllers\AdminController::class, 'themes'])->middleware(['auth', 'admin']);
Route::any('/cp/products', [\App\Http\Controllers\AdminController::class, 'products'])->middleware(['auth', 'admin']);
Route::any('/cp/products/plugins', [\App\Http\Controllers\AdminController::class, 'products'])->middleware(['auth', 'admin']);
Route::any('/cp/blogs', [\App\Http\Controllers\AdminController::class, 'blogs'])->middleware(['auth', 'admin']);


