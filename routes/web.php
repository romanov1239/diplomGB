<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\New\MainController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
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
    return view('welcome');
});
Route::get('/admin', function () {
    return view('admin')->middleware('auth');
});
Route::get('/users', [UsersController::class, 'index']);


//Route::get('/', [MainController::class, 'index']);
Route::get('/users', [MainController::class, 'users']);
Route::get('/users/{id}', [MainController::class, 'user']);
Route::get('roles', [RolesController::class, 'index']);
Route::get('roles/{role}', [RolesController::class, 'show']);
Route::get('roles/{role}/users', [RolesController::class, 'users']);





Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('home', [AuthController::class, 'home']);
});



Route::middleware(['roles:admin'])->group(function () {
    //Route::get('roles', [RolesController::class, 'index']);
    Route::post('roles', [RolesController::class, 'create']);
    Route::put('roles/{role}', [RolesController::class, 'update']);

    //Route::get('roles/{role}', [RolesController::class, 'show']);
    //Route::get('roles/{role}/users', [RolesController::class, 'users']);
});

Route::middleware(['roles:admin'])->group(function () {

});

/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/users', [UsersController::class, 'index']);

require __DIR__.'/auth.php';

*/





