<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Admin/Dashboard', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });
});

Route::middleware(['auth', 'verified'])->prefix('')->group( function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::group(['prefix' => 'project'],function () {
            Route::get('/', [ProjectController::class, 'index'])->name('project.index');

            Route::get('/detail/{slug}', [ProjectController::class, 'show'])->name('project.detail');

            // create
            Route::get('/create', [ProjectController::class, 'create'])->name('project.create');
            Route::post('/', [ProjectController::class, 'store'])->name('project.store');

            // edit
            Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
            Route::post('/{id}', [ProjectController::class, 'update'])->name('project.update');

            // delete
            Route::get('/delete/{id}', [ProjectController::class, 'destroy'])->name('project.delete');

            //
            Route::get('/search',[ProjectController::class, 'search'])->name('project.search');

    });

    // Not Yet Worked - 28/11/2024
    Route::group(['prefix' => 'gallery'],function () {
            Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');


            // create
            Route::get('/create', [GalleryController::class, 'create'])->name('gallery.create');
            Route::post('/', [GalleryController::class, 'store'])->name('gallery.store');

            // edit
            Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
            Route::post('/{id}', [GalleryController::class, 'update'])->name('gallery.update');

            // delete
            Route::get('/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');
    });

    // Not Yet Worked - 28/11/2024
    Route::group(['prefix' => 'blog'],function () {
            Route::get('/', [BlogController::class, 'index'])->name('blog.index');


            // create
            Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
            Route::post('/', [BlogController::class, 'store'])->name('blog.store');

            // edit
            Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
            Route::post('/{id}', [BlogController::class, 'update'])->name('blog.update');

            // delete
            Route::get('/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
