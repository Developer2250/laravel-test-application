<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProgramController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('categories', CategoryController::class);

Route::get('program1', [ProgramController::class, 'program1']);
Route::get('program2', [ProgramController::class, 'program2']);
