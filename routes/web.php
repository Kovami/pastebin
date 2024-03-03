<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Paste\CreateController as CreatePasteController;
use App\Http\Controllers\Paste\MyPastesController;
use App\Http\Controllers\Paste\ShowController as ShowPasteController;
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

Route::get('/', [CreatePasteController::class, 'create'])
    ->name('main');

Route::post('/', [CreatePasteController::class, 'store']);

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisterController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('my', [MyPastesController::class, 'create'])
        ->name('my');

    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout');
});

Route::get('/{uri}', [ShowPasteController::class, 'create'])
    ->name('paste-show');
