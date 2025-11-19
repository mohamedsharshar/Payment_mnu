<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\RestoreController;

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

    // Restore Routes
    Route::prefix('restore')->name('restore.')->group(function () {
        // Customers
        Route::get('customers', [RestoreController::class, 'trashedCustomers'])->name('customers');
        Route::post('customers/{code}', [RestoreController::class, 'restoreCustomer'])->name('customers.restore');
        Route::delete('customers/{code}', [RestoreController::class, 'forceDeleteCustomer'])->name('customers.force-delete');

        // Bills
        Route::get('bills', [RestoreController::class, 'trashedBills'])->name('bills');
        Route::post('bills/{id}', [RestoreController::class, 'restoreBill'])->name('bills.restore');
        Route::delete('bills/{id}', [RestoreController::class, 'forceDeleteBill'])->name('bills.force-delete');

        // Services
        Route::get('services', [RestoreController::class, 'trashedServices'])->name('services');
        Route::post('services/{id}', [RestoreController::class, 'restoreService'])->name('services.restore');
        Route::delete('services/{id}', [RestoreController::class, 'forceDeleteService'])->name('services.force-delete');

        // Users
        Route::get('users', [RestoreController::class, 'trashedUsers'])->name('users');
        Route::post('users/{id}', [RestoreController::class, 'restoreUser'])->name('users.restore');
        Route::delete('users/{id}', [RestoreController::class, 'forceDeleteUser'])->name('users.force-delete');
    });
});
