<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\inprojectController;

Route::get('/', function () {
    return view('welcome');
});

// Routes untuk Project
Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('projects/show/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('projects/edit/{project}', [ProjectController::class, 'edit'])->name('projects.edit');
Route::get('projects/update/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::get('projects/destroy/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

// Routes untuk Category (kategori dalam project)
Route::get('projects/{project}/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('projects/{project}/categories', [CategoryController::class, 'store'])->name('categories.store');

// web.php

// web.php
Route::get('/projects/{project}/category/{category}', [ProjectController::class, 'showCategory'])->name('projects.category');

Route::get('/projects/{project}/lan/create', [LanController::class, 'create'])->name('lan.create');
Route::get('/projects/{project}/lan', [LanController::class, 'index'])->name('lan.index');


