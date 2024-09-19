<?php

use App\Http\Controllers\inprojectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/project', function () {
    return view('project');
});

Route::get('/inproject', function () {
    return view('inproject');
});

Route::get('/inproject/lan', [inprojectController::class, 'index'])->name('inproject.lan');