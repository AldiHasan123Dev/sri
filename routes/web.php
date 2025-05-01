<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use Livewire\Volt\Volt;
use App\Http\Controllers\PengurusController;

Route::get('/', function () {
    return view('landing.index');
})->name('home');

Route::get('/blog', function () {
    return view('landing.blog');
})->name('blog');

Route::get('/blog-details', function () {
    return view('landing.blog-details');
})->name('blog-details');

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
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/admin/pengurus', [PengurusController::class, 'index'])->name('pengurus.index');
    // Menyimpan data pengurus
    Route::post('/admin/pengurus/simpan', [PengurusController::class, 'store'])->name('pengurus.store');
    Route::get('pengurus/{id}/edit', [PengurusController::class, 'edit'])->name('pengurus.edit');
    Route::delete('pengurus/{id}', [PengurusController::class, 'destroy'])->name('pengurus.destroy');
    Route::put('pengurus/{id}', [PengurusController::class, 'update'])->name('pengurus.update');
    
Route::resource('berita', BeritaController::class);
// Route untuk mengubah status berita menjadi "Published"
Route::post('/berita/{id}/publish', [BeritaController::class, 'publish'])->name('berita.publish');

    
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
