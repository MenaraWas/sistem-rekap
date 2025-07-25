<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPostController;
use App\Http\Controllers\LinkExtractorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [PublicPostController::class, 'create'])->name('public.form');
Route::post('/', [PublicPostController::class, 'store'])
    ->name('public.store')
    ->middleware('throttle.form');
Route::get('/extract', [LinkExtractorController::class, 'extract']);
