<?php

use App\Http\Controllers\ItemController;
use App\Models\Item;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'totalJenis' => Item::count(),
            'totalStok'  => (int) Item::sum('jumlah'),
        ]);
    })->name('dashboard');

    Route::get('/tentang', function () {
        return Inertia::render('Tentang');
    })->name('tentang');
    
    Route::resource('items', ItemController::class)->except(['show']);
});
require __DIR__.'/auth.php';