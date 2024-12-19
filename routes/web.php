<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PenerimaBantuanController;

use App\Http\Controllers\PenerimaBansosController;

use App\Http\Controllers\InfoPembuatController;
use App\Http\Controllers\InfoAboutController;



Route::get('/', [PenerimaBansosController::class, 'index'])->name('penerima.bansos'); //JANGAN DIUBAH!!



Route::get('/info-pembuat', [InfoAboutController::class, 'index'])->name('info.pembuat');
Route::get('/penerima-bansos', [PenerimaBansosController::class, 'index'])->name('penerimaBansos.index');


// Route::get('/browse/{category:slug}', [FrontController::class, 'category'])->name('front.category');

// Route::get('/details/{workshop:slug}', [FrontController::class, 'details'])->name('front.details');

// Route::get('/check-booking', [BookingController::class, 'checkBooking'])->name('front.check_booking');
// Route::post('/check-booking/details', [BookingController::class, 'checkBookingDetails'])->name('front.check_booking_details');

// Route::get('/booking/payment', [BookingController::class, 'payment'])->name('front.payment');
// Route::post('/booking/payment', [BookingController::class, 'paymentStore'])->name('front.payment_store');

// Route::get('/booking/{workshop:slug}', [BookingController::class, 'booking'])->name('front.booking');
// Route::post('/booking/{workshop:slug}', [BookingController::class, 'bookingStore'])->name('front.booking_store');

// Route::get('/booking/finished/{bookingTransaction}', [BookingController::class, 'bookingFinished'])->name('front.booking_finished');

