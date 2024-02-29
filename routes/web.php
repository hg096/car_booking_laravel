<?php

use App\Http\Controllers\BookingDateController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// 차량 리스트
Route::get('/', [CarsController::class, 'list']);

// 차량등록페이지 조회
Route::get('/create', function () {
    return Inertia::render('CarBookingRegi');
});

// 자동차조회
Route::get('/show/{id}', [CarsController::class, 'showDetail']);

// 예약하기 조회
Route::get('/reservation', function () {
    return Inertia::render('CarBookingMake');
});


// 예약하기 데이터 전송
Route::post('/reservation', [BookingDateController::class, 'getBooking'])->name('cars.getBooking');

// 차량등록 전송
Route::post('/createcar', [CarsController::class, 'createCar'])->name('cars.create');

// 차량 날짜 조회
Route::post('/confirm-date', [BookingDateController::class, 'confirmDate'])->name('cars.confirmDate');

// 차량 예약
Route::post('/car-booking', [BookingDateController::class, 'createBooking'])->name('cars.booking');


//


Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
