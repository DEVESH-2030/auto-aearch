<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoSearchController;

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


Route::get('/', [AutoSearchController::class, 'index'])->name('auto-search.index');

/**
 * route to save auto search data in database but not working right now only dd() here
 * please verify
 */
Route::post('/save-location', [AutoSearchController::class, 'store'])->name('save-location');


// Route::get('/', function () {
//     return view('welcome');
// });
