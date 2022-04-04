

<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TosterController;



// Discount
Route::get('/getDiscount', [FrontController::class, 'discountForm'])->name('discount.index');
Route::post('/getDiscount', [FrontController::class, 'storeDiscountForm'])->name('discount.store');
// articles
Route::get('/articles', [FrontController::class , 'getArticles'])->name('front.article');

// teams
Route::get('/team', [FrontController::class, 'getTeams'])->name('front.team');
// services
Route::get('/details', [FrontController::class, 'getServicesDetails'])->name('front.service-details');

// toster controllers
Route::get('/toster', [TosterController::class, 'index'])->name('toster.index');
Route::post('/toster', [TosterController::class, 'store'])->name('toster.store');


