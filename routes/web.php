<?php

use App\Http\Controllers\HomeController;
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
    return view('auth.login');
});
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

route::middleware('admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/card_found', [App\Http\Controllers\HomeController::class, 'cardFound'])->name('cardFound');
    route::get('get_cards', [HomeController::class, 'getCards'])->name('get.cards');
    route::get('get_cards_found', [HomeController::class, 'getCardsFound'])->name('get.cards.found');
    route::get('card_found/{card_id}', [HomeController::class, 'cardIsFound'])->name('cards.found');
});