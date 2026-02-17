<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/campaigns', [SiteController::class, 'campaigns'])->name('campaigns');
Route::get('/campaigns/{campaign:slug}', [SiteController::class, 'campaign'])->name('campaign');
Route::get('/transparency', [SiteController::class, 'transparency'])->name('transparency');
Route::get('/artisans', [SiteController::class, 'artisans'])->name('artisans');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/donate', [SiteController::class, 'donate'])->name('donate');
Route::post('/donate', [SiteController::class, 'storeDonation'])->name('donate.store');
