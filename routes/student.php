<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\FacultyController;
use App\Http\Controllers\Student\ReceiptController;
use App\Http\Controllers\Student\NotificationController;

Route::prefix('student')->middleware(['auth', 'student'])->name('student.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/faculty', [FacultyController::class, 'show'])->name('faculty');
    Route::get('/faculty/export-pdf', [FacultyController::class, 'exportPdf'])->name('faculty.export.pdf');
    Route::get('/receipts', [ReceiptController::class, 'index'])->name('receipts.index');
    Route::get('/receipts/search', [ReceiptController::class, 'search'])->name('receipts.search');
    Route::get('/receipts/export', [ReceiptController::class, 'export'])->name('receipts.export');
    Route::get('/receipts/export-pdf', [ReceiptController::class, 'exportPdf'])->name('receipts.export.pdf');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});
