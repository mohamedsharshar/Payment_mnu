<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\FacultyController;
use App\Http\Controllers\Student\ReceiptController;

Route::prefix('student')->middleware(['auth', 'student'])->name('student.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/faculty', [FacultyController::class, 'show'])->name('faculty');
    Route::get('/receipts', [ReceiptController::class, 'index'])->name('receipts.index');
    Route::get('/receipts/search', [ReceiptController::class, 'search'])->name('receipts.search');
    Route::get('/receipts/export', [ReceiptController::class, 'export'])->name('receipts.export');
});
