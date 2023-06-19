<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileExplorerController;

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
    return redirect('read-excel');
});

Route::get('login', [AuthController::class, 'formLogin']);
Route::post('login', [AuthController::class, 'submitLogin']);
Route::get('logout', [AuthController::class, 'logout']);

Route::middleware('checkAuth')->group(function(){
    Route::get('read-excel', [FileExplorerController::class, 'readExcel']);
});