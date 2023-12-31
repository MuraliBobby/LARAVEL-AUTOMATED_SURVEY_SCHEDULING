<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\generate_survey_form;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\send_availability_details_to_dashboard;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/survey', [UserController::class, 'display'])->name('details.display');
    Route::post('/survey', [UserController::class, 'storeDetails'])->name('details.store');
    // Route::get('/dashboard', [generate_survey_form::class, 'showDashboard'])->name('dashboard');
    Route::get('/dashboard', [send_availability_details_to_dashboard::class, 'sendDetails'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
