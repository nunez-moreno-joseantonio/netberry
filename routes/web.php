<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\CategoriaController;

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
    return view('ppal');
});


Route::group(['prefix' => 'tareas'], function() {
    Route::get('list', [TareaController::class, 'getAll']);
    Route::post('create', [TareaController::class, 'create']);
    Route::post('delete', [TareaController::class, 'delete']);
});

Route::group(['prefix' => 'categorias'], function() {
    Route::get('list', [CategoriaController::class, 'getAll']);
});

