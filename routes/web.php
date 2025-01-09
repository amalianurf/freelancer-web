<?php

use Illuminate\Support\Facades\Route;

// landing
use App\Http\Controllers\Landing\LandingController;

// dashboard
use App\Http\Controllers\Dashboard\MemberController;
use App\Http\Controllers\Dashboard\MyOrderController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RequestController;
use App\Http\Controllers\Dashboard\ServiceController;

Route::resource('/', LandingController::class);
Route::get('explore', [LandingController::class, 'explore'])->name('landing.explore');
Route::get('detail/{id}', [LandingController::class, 'detail'])->name('landing.detail');
Route::get('booking/{id}', [LandingController::class, 'booking'])->name('landing.booking');
Route::get('detail_booking/{id}', [LandingController::class, 'detail_booking'])->name('landing.detail.booking');

Route::prefix('member')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->name('member.')->group( function () {
    Route::resource('dashboard', MemberController::class);
    
    Route::resource('service', ServiceController::class);
    
    Route::resource('request', RequestController::class);
    Route::get('approve_request/{id}', [RequestController::class, 'approve'])->name('approve.request');
    
    Route::resource('order', MyOrderController::class);
    Route::get('accept/order/{id}', [MyOrderController::class, 'accepted'])->name('accept.order');
    Route::get('reject/order/{id}', [MyOrderController::class, 'rejected'])->name('reject.order');
    
    Route::resource('profile', ProfileController::class);
    Route::get('delete_photo', [ProfileController::class, 'delete'])->name('delete.photo.profile');
});
// Route::group(['prefix' => 'member', 'as' => 'member.', 'middleware' => ['auth:sanctum', 'verified']],
// function () {
// });