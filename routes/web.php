<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Routing\RouteGroup;




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


Auth::routes();


Route::middleware(['HasAccessToImportProducts'])->group(function () {
    Route::get('ProductImport' , [ProductController::class, 'ImportView'])->name('ProductImportView');
    Route::post('ProductImport' , [ProductController::class, 'Import'])->name('ProductImport');
    Route::get('ConfirmImport' , [ProductController::class, 'ConfirmImportView'])->name('ConfirmInport');

    Route::post('ConfirmImport' , [ProductController::class, 'ConfirmImport'])->name('ConfirmInport');
});

