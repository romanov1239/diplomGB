<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
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



Route::get('/custom_users', [UsersController::class, 'index']);
Route::post('/custom_users', [UsersController::class, 'store']);
Route::put('/custom_users/{id}', [UsersController::class, 'update']);
Route::delete('/custom_users/{id}', [UsersController::class, 'delete']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
