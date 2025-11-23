<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');
Route::prefix('project')->as('project.')->group(function () {
    Route::get('/all', [WebController::class, 'projects'])->name('all');
    Route::get('/{id}', [WebController::class, 'project'])->name('single');
});
Route::prefix('services')->as('services.')->group(function () {
    Route::get('/all', [WebController::class, 'services'])->name('all');
    Route::get('/{slug}', [WebController::class, 'servicesDetails'])->name('details');
});

Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Projects
    Route::resource('projects', ProjectController::class);
    Route::post('projects/{project}/toggle-status', [ProjectController::class, 'toggleStatus'])
        ->name('projects.toggle-status');
    Route::delete('projects/{project}/gallery-image/{imageIndex}', [ProjectController::class, 'removeGalleryImage'])
        ->name('projects.remove-gallery-image');

    // Services
    Route::resource('services', ServiceController::class);
    Route::post('services/{service}/toggle', [ServiceController::class, 'toggle'])->name('services.toggle');
    Route::post('services/update-order', [ServiceController::class, 'updateOrder'])->name('services.update-order');
    Route::delete('services/{service}/delete-image', [ServiceController::class, 'deleteImage'])->name('services.delete-image');

    // Brands
    Route::resource('brands', BrandController::class);
    Route::post('brands/{brand}/toggle-status', [BrandController::class, 'toggleStatus'])
        ->name('brands.toggle-status');
});
