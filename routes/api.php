<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\ApiAuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductApiController::class, 'index'])->name('product.index');
Route::get('/products/{id}', [ProductApiController::class, 'show'])->name('product.show');

Route::post('/authenticate',[ApiAuthController::class, 'authenticate'])->name('api.auth');

Route::middleware('jwt.auth')->group(function () {

    Route::post('/products/create', [ProductApiController::class, 'create'])->name('product.create');

    Route::post('/products/{id}/update', [ProductApiController::class, 'update'])->name('product.update');

    Route::post('/products/{id}/delete', [ProductApiController::class, 'delete'])->name('product.delete');

    Route::post('/products/{id}/delete/prices', [ProductApiController::class, 'deleteWithPrices'])->name('product.delete.with.prices');

});


