<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CtnReservationMessageController;
use App\Http\Controllers\VehicleSpecificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/reservation-ctn', 'reservation-ctn')->name('reservation.ctn');
Route::post('/reservation-ctn', [CtnReservationMessageController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('reservation.ctn.store');

Route::prefix('vehicle-specifications')->middleware('throttle:30,1')->group(function (): void {
    Route::get('/years', [VehicleSpecificationController::class, 'years'])->name('vehicle-specifications.years');
    Route::get('/dimensions', [VehicleSpecificationController::class, 'dimensions'])->name('vehicle-specifications.dimensions');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:3,1');
});

Route::middleware('auth')->group(function (): void {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/backoffice/reservations-ctn', [CtnReservationMessageController::class, 'index'])
        ->name('backoffice.ctn-reservations.index');
    Route::get('/backoffice/reservations-ctn/{ctnReservationMessage}', [CtnReservationMessageController::class, 'show'])
        ->name('backoffice.ctn-reservations.show');
    Route::patch('/backoffice/reservations-ctn/{ctnReservationMessage}/status', [CtnReservationMessageController::class, 'updateStatus'])
        ->name('backoffice.ctn-reservations.update-status');
    Route::middleware('admin')->prefix('/backoffice/users')->name('backoffice.users.')->group(function (): void {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
