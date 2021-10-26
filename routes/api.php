<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route::post('register', [AuthController::class, 'register']);
route::post('login', [AuthController::class, 'login']);
route::post('activation', [AuthController::class, 'activation'])->middleware('auth:api');

route::middleware(['auth:api', 'activation'])->group(function () {

    route::get('get_cards', [CardController::class, 'getCards']);

    route::post('add_card', [CardController::class, 'addCard']);
    route::post('is_found_card', [CardController::class, 'isFoundCard']);
    route::post('serach_Card', [CardController::class, 'searchCard']);
});