<?php

use Azuriom\Plugin\Uploader\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your plugin. These
| routes are loaded by the RouteServiceProvider of your plugin within
| a group which contains the "web" middleware group and your plugin name
| as prefix. Now create something great!
|
*/

Route::get('/', [AdminController::class, 'index']);
Route::post('/add', [AdminController::class, 'add'])->name('file.add');
Route::post('/remove/{id}', [AdminController::class, 'destroy'])->name('file.remove');
