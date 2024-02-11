<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\AboutSectionSettingsController;
use App\Http\Controllers\Settings\ContactSectionSettingsController;
use App\Http\Controllers\Settings\GeneralSettingsController;
use App\Http\Controllers\Settings\HeroSectionSettingsController;
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

Route::get('/', function () {
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

    Route::prefix('settings')->group(function () {
        Route::get('/general', GeneralSettingsController::class)->name('settings.general');

        Route::get('/hero-section', [HeroSectionSettingsController::class, 'index'])->name('hero-section');
        Route::put('/hero-section', [HeroSectionSettingsController::class, 'update'])->name('hero-section.update');

        Route::get('/about-section', [AboutSectionSettingsController::class, 'index'])->name('about-section');
        Route::put('/about-section', [AboutSectionSettingsController::class, 'update'])->name('about-section.update');

        Route::get('/contact-section', [ContactSectionSettingsController::class, 'index'])->name('contact-section');
        Route::put('/contact-section', [ContactSectionSettingsController::class, 'update'])->name('contact-section.update');
    });
});

require __DIR__ . '/auth.php';
