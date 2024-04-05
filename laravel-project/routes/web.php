<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\Income_sourcesController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\IncomeCategoryController;

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

Route::get('/', [IndexController::class, 'index']);

Route::resource('incomes', IncomeController::class);

Route::resource('income_sources', Income_sourcesController::class);

Route::resource('spendings', SpendingController::class);

Route::resource('categories', CategoriesController::class);

Route::resource('income_categories', IncomeCategoryController::class);

require __DIR__.'/auth.php';