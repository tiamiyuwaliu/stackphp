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

Route::any('/publish', [\App\Http\Controllers\PublishController::class, 'index'])->middleware(['auth']);
Route::any('/publish/published', [\App\Http\Controllers\PublishController::class, 'index'])->middleware(['auth']);
Route::any('/publish/unpublished', [\App\Http\Controllers\PublishController::class, 'index'])->middleware(['auth']);
Route::any('/publish/bulk', [\App\Http\Controllers\PublishController::class, 'bulk'])->middleware(['auth']);
Route::any('/publish/rss', [\App\Http\Controllers\PublishController::class, 'rss'])->middleware(['auth']);
Route::any('/calendar/data', [\App\Http\Controllers\PublishController::class, 'calendarData'])->middleware(['auth']);
Route::any('/media', [\App\Http\Controllers\MediaController::class, 'index'])->middleware(['auth']);
Route::any('/templates', [\App\Http\Controllers\TemplateController::class, 'index'])->middleware(['auth']);
Route::any('/templates/hashtag', [\App\Http\Controllers\TemplateController::class, 'index'])->middleware(['auth']);
Route::any('/publish/bulk', [\App\Http\Controllers\PublishController::class, 'bulk'])->middleware(['auth']);
Route::any('/publish/rss', [\App\Http\Controllers\PublishController::class, 'rss'])->middleware(['auth']);
Route::any('/publish/rss/{id}', [\App\Http\Controllers\PublishController::class, 'rssPage'])->middleware(['auth']);
Route::any('/channels', [\App\Http\Controllers\ChannelController::class, 'index'])->middleware(['auth']);
Route::any('/channel/facebook', [\App\Http\Controllers\ChannelController::class, 'facebook'])->middleware(['auth']);
Route::any('/channel/twitter', [\App\Http\Controllers\ChannelController::class, 'twitter'])->middleware(['auth']);
Route::any('/channel/linkedin', [\App\Http\Controllers\ChannelController::class, 'linkedin'])->middleware(['auth']);
Route::any('/channel/pinterest', [\App\Http\Controllers\ChannelController::class, 'pinterest'])->middleware(['auth']);
Route::any('/channel/reddit', [\App\Http\Controllers\ChannelController::class, 'reddit'])->middleware(['auth']);
Route::any('/channel/tumblr', [\App\Http\Controllers\ChannelController::class, 'tumblr'])->middleware(['auth']);
Route::any('/channel/telegram', [\App\Http\Controllers\ChannelController::class, 'telegram'])->middleware(['auth']);
Route::any('/channel/instagram', [\App\Http\Controllers\ChannelController::class, 'instagram'])->middleware(['auth']);
Route::any('/channel/tiktok', [\App\Http\Controllers\ChannelController::class, 'tiktok'])->middleware(['auth']);
Route::any('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->middleware(['auth']);

Route::any('/builder/bio', [\App\Http\Controllers\BuilderController::class, 'index'])->middleware(['auth']);
Route::any('/builder/bio/{id}', [\App\Http\Controllers\BuilderController::class, 'bioPage'])->middleware(['auth']);
Route::any('/builder/bio/reports/{id}', [\App\Http\Controllers\BuilderController::class, 'report'])->middleware(['auth']);
Route::any('/builder/link', [\App\Http\Controllers\BuilderController::class, 'link'])->middleware(['auth']);
Route::any('/builder/vcard', [\App\Http\Controllers\BuilderController::class, 'vcard'])->middleware(['auth']);
Route::any('/builder/qrcode', [\App\Http\Controllers\BuilderController::class, 'qrcode'])->middleware(['auth']);

Route::any('/account', [\App\Http\Controllers\ProfileController::class, 'index'])->middleware(['auth']);
Route::any('/account/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->middleware(['auth']);
Route::any('/account/security', [\App\Http\Controllers\ProfileController::class, 'index'])->middleware(['auth']);
Route::any('/account/notification', [\App\Http\Controllers\ProfileController::class, 'index'])->middleware(['auth']);
Route::any('/account/api', [\App\Http\Controllers\ProfileController::class, 'index'])->middleware(['auth']);
Route::any('/account/cancel', [\App\Http\Controllers\ProfileController::class, 'index'])->middleware(['auth']);
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
Route::any('/cp/settings/links', [\App\Http\Controllers\AdminController::class, 'settings'])->middleware(['auth', 'admin']);

Route::any('/cp/email', [\App\Http\Controllers\AdminController::class, 'email'])->middleware(['auth', 'admin']);
Route::any('/cp/modules', [\App\Http\Controllers\AdminController::class, 'modules'])->middleware(['auth', 'admin']);
Route::any('/cp/pages', [\App\Http\Controllers\AdminController::class, 'pages'])->middleware(['auth', 'admin']);
Route::any('/cp/themes', [\App\Http\Controllers\AdminController::class, 'themes'])->middleware(['auth', 'admin']);


Route::any('/{id}', [\App\Http\Controllers\BuilderController::class, 'viewer'])->middleware(['auth']);
