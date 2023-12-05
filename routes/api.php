
<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(TransactionController::class)
    ->prefix('transactions')
    ->group(function () {
        Route::get('/user/{id}', 'showUsersTransactions');
        Route::post('/', 'createTransaction');
    });
