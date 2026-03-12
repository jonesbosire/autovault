<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\MyListingController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SavedVehicleController;
use App\Http\Controllers\CompareController;
use Illuminate\Support\Facades\Route;

// ── Public ───────────────────────────────────────────────────────────────────

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cars', [VehicleController::class, 'index'])->name('cars.index');
Route::get('/cars/{vehicle:slug}', [VehicleController::class, 'show'])->name('cars.show');

Route::post('/cars/{vehicle}/enquire', [EnquiryController::class, 'store'])
    ->name('cars.enquire')
    ->middleware('throttle:3,1');

Route::get('/pricing',  [PageController::class, 'pricing'])->name('pricing');
Route::get('/about',    [PageController::class, 'about'])->name('about');
Route::get('/contact',  [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/faq',      [PageController::class, 'faq'])->name('faq');
Route::get('/terms',    [PageController::class, 'terms'])->name('terms');
Route::get('/privacy',  [PageController::class, 'privacy'])->name('privacy');
Route::get('/blog',          [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}',   [PageController::class, 'blogPost'])->name('blog.show');

// ── Compare (public, session-based) ─────────────────────────────────────────

Route::get('/compare',                     [CompareController::class, 'show'])->name('compare');
Route::post('/compare/toggle/{vehicle}',   [CompareController::class, 'toggle'])->name('compare.toggle');
Route::post('/compare/remove/{vehicle}',   [CompareController::class, 'remove'])->name('compare.remove');
Route::post('/compare/clear',              [CompareController::class, 'clear'])->name('compare.clear');

// ── Auth (Fortify handles /login, /register, /logout) ────────────────────────

Route::get('/auth/google',          [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');

// ── Seller (authenticated, non-admin) ────────────────────────────────────────

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // My Listings
    Route::get('/my-listings',           [MyListingController::class, 'index'])->name('my-listings.index');
    Route::get('/my-listings/create',    [MyListingController::class, 'create'])->name('my-listings.create');
    Route::post('/my-listings',          [MyListingController::class, 'store'])->name('my-listings.store');
    Route::get('/my-listings/{vehicle}', [MyListingController::class, 'show'])->name('my-listings.show');

    // Profile
    Route::get('/profile',             [ProfileController::class, 'show'])->name('profile');
    Route::patch('/profile',           [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password',  [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Saved / Favourites
    Route::get('/my-favorites',                       [SavedVehicleController::class, 'index'])->name('my-favorites');
    Route::post('/my-favorites/toggle/{vehicle}',     [SavedVehicleController::class, 'toggle'])->name('my-favorites.toggle');
});

// ── Payment Callbacks ─────────────────────────────────────────────────────────

Route::post('/payments/mpesa/callback',       'App\Http\Controllers\Payment\MpesaController@callback')
    ->name('payments.mpesa.callback')->withoutMiddleware(['web']);
Route::get('/payments/flutterwave/callback',  'App\Http\Controllers\Payment\FlutterwaveController@callback')
    ->name('payments.flutterwave.callback');
