<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CurriculamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StripePaymentController;

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
    Route::resource('course', CourseController::class);
    Route::resource('class', CurriculamController::class);
    Route::resource('question', QuestionController::class);
    Route::resource('quiz', QuizController::class);

    Route::get('/quiz-test/{id}',[QuizController::class, 'quizTest'])->name('quiz-test');
    Route::post('/stripe-payment', [StripePaymentController::class, 'stripePayment'])->name('stripe-payment');
});

require __DIR__.'/auth.php';
