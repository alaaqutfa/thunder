<?php

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
    Route::get('/{id}', [WebController::class, 'servicesDetails'])->name('details');
});
