<?php

use App\Http\Controllers\ManageCustomersController;
use App\Http\Controllers\ManageInvoiceLinesController;
use App\Http\Controllers\ManageInvoicesController;
use App\Http\Controllers\ManagePaymentsController;
use Illuminate\Support\Facades\Route;

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


require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/customers', ManageCustomersController::class)->name('customers');
    Route::get('/invoices/{customerId}', ManageInvoicesController::class)->name('customer.invoices');
    Route::get('/invoice/{invoice}/edit', ManageInvoiceLinesController::class)->name('customer.invoice.lines');
    Route::get('/payments/{customerId}', ManagePaymentsController::class)->name('customer.payments');


});
