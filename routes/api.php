<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\CategorieController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('/Categories', CategorieController::class);



Route::get('/livres/trashed', [LivreController::class, 'trashed']);
Route::post('/livres/restore/{livre}', [LivreController::class,'restore']);
Route::post('/livres/force-delete/{livre}', [LivreController::class, 'forceDelete']);
Route::post('/livres/soft-delete/{livre}', [LivreController::class,'softDelete']);
// apirossour livres
Route::apiResource('/livres', LivreController::class);

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class,'refreshToken']);

    // Only restore soft deleted records

});
