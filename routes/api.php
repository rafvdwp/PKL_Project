<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintPDFController;
use App\Http\Controllers\CustomPDFController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("Header", [CustomPDFController::class, 'Header'])->name('header');
Route::get("Footer", [CustomPDFController::class, 'Footer'])->name('footer');
Route::get("print", [PrintPDFController::class, 'print'])->name('printpdf');
