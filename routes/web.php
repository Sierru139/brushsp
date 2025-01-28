<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectCodeController;
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

    Route::group(['prefix' => 'clients'],function () {
            Route::get('/', [ClientController::class, 'index'])->name('clients.index');

            Route::get('/detail/{slug}', [ClientController::class, 'show'])->name('clients.detail');

            // create
            Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
            Route::post('/', [ClientController::class, 'store'])->name('clients.store');

            // edit
            Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');
            Route::post('/{id}', [ClientController::class, 'update'])->name('clients.update');

            // delete
            Route::get('/delete/{id}', [ClientController::class, 'destroy'])->name('clients.delete');

            //
            Route::get('/search',[ClientController::class, 'search'])->name('clients.search');
    });

    Route::group(['prefix' => 'teams'],function () {
            Route::get('/', [TeamController::class, 'index'])->name('teams.index');

            Route::get('/detail/{slug}', [TeamController::class, 'show'])->name('teams.detail');

            // create
            Route::get('/create', [TeamController::class, 'create'])->name('teams.create');
            Route::post('/', [TeamController::class, 'store'])->name('teams.store');

            // edit
            Route::get('/edit/{id}', [TeamController::class, 'edit'])->name('teams.edit');
            Route::post('/{id}', [TeamController::class, 'update'])->name('teams.update');

            // delete
            Route::get('/delete/{id}', [TeamController::class, 'destroy'])->name('teams.delete');

            //
            Route::get('/search',[TeamController::class, 'search'])->name('teams.search');
    });

    Route::group(['prefix' => 'project-code'],function () {
            Route::get('/', [ProjectCodeController::class, 'index'])->name('projectCode.index');

            Route::get('/detail/{slug}', [ProjectCodeController::class, 'show'])->name('projectCode.detail');

            // create
            Route::get('/create', [ProjectCodeController::class, 'create'])->name('projectCode.create');
            Route::post('/', [ProjectCodeController::class, 'store'])->name('projectCode.store');

            // edit
            Route::get('/edit/{id}', [ProjectCodeController::class, 'edit'])->name('projectCode.edit');
            Route::post('/{id}', [ProjectCodeController::class, 'update'])->name('projectCode.update');

            // delete
            Route::get('/delete/{id}', [ProjectCodeController::class, 'destroy'])->name('projectCode.delete');

            //
            Route::get('/search',[ProjectCodeController::class, 'search'])->name('projectCode.search');
    });

    // Not Yet Worked - 28/11/2024
    // Route::group(['prefix' => 'gallery'],function () {
    //         Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');


    //         // create
    //         Route::get('/create', [GalleryController::class, 'create'])->name('gallery.create');
    //         Route::post('/', [GalleryController::class, 'store'])->name('gallery.store');

    //         // edit
    //         Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
    //         Route::post('/{id}', [GalleryController::class, 'update'])->name('gallery.update');

    //         // delete
    //         Route::get('/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.delete');
    // });

    // // Not Yet Worked - 28/11/2024
    // Route::group(['prefix' => 'blog'],function () {
    //         Route::get('/', [BlogController::class, 'index'])->name('blog.index');


    //         // create
    //         Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
    //         Route::post('/', [BlogController::class, 'store'])->name('blog.store');

    //         // edit
    //         Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    //         Route::post('/{id}', [BlogController::class, 'update'])->name('blog.update');

    //         // delete
    //         Route::get('/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
    // });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
