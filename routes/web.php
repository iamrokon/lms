<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\InvoiceController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function(){
    Route::resource('lead', LeadController::class);
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::get('/admission', [AdmissionController::class, 'admission'])->name('admission');
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices');
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice-detail');
});

require __DIR__.'/auth.php';
