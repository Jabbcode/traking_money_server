<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
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


Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::get('users', [AuthController::class, 'Users']);

    Route::resource('categories', CategoryController::class);

    Route::resource('accounts', AccountsController::class);
    Route::delete('accounts/{account_id}/user/{user_id}', [AccountsController::class, 'ToUnsubscribe']);

    Route::resource('transactions', TransactionController::class);
    Route::get('/transactions/type_transaction/{type_transaction_id}', [TransactionController::class, 'getForCategory']);
});
