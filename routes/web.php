<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use Livewire\Volt\Volt;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;

Route::get('/', function () {
    return view('landing.index');
})->name('home');

Route::get('/blog', [LandingPageController::class, 'index'])->name('blog.index');

// Route untuk menampilkan detail blog berdasarkan slug
Route::get('/blog/{slug}', [LandingPageController::class, 'show'])->name('blog.show');

Route::get('/about', function () {
    return view('landing.about');
})->name('about');

Route::get('/portofolio', function () {
    return view('landing.portofolio');
})->name('portofolio');

Route::get('/pendidikan', function () {
    return view('landing.service');
})->name('pendidikan');

Route::get('/portofolio-details', function () {
    return view('landing.portofolio-details');
})->name('portofolio-details');

Route::get('/pricing', function () {
    return view('landing.pricing');
})->name('pricing');

Route::get('/contact', function () {
    return view('landing.contact');
})->name('contact');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//admin
Route::get('/login-admin', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login-auth', [AuthController::class, 'login'])->name('login.auth');

// Grup route dengan middleware 'auth'
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/admin/pengurus', [PengurusController::class, 'index'])->name('pengurus.index');
    Route::post('/admin/pengurus/simpan', [PengurusController::class, 'store'])->name('pengurus.store');
    Route::get('/pengurus/{id}/edit', [PengurusController::class, 'edit'])->name('pengurus.edit');
    Route::delete('/pengurus/{id}', [PengurusController::class, 'destroy'])->name('pengurus.destroy');
    Route::put('/pengurus/{id}', [PengurusController::class, 'update'])->name('pengurus.update');

    Route::resource('berita', BeritaController::class);
    Route::post('/berita/{id}/publish', [BeritaController::class, 'publish'])->name('berita.publish');
});
