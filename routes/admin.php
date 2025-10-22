<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportController;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('customers', CustomerController::class);

    Route::resource('bills', BillController::class);

    Route::resource('services', ServiceController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');

    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');

    Route::get('settings', function() {
        return view('admin.settings');
    })->name('settings');
});
