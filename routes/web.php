<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;

Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/albums/{slug}', [GalleryController::class, 'album'])->name('gallery.album');
Route::get('/photos/{id}', [GalleryController::class, 'show'])->name('gallery.show');
Route::post('/photos/{id}/report', [ReportController::class, 'store'])->middleware('auth')->name('report.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'blocked'])->group(function () {
    Route::get('/photos/upload', [PhotoController::class, 'create'])->name('photos.create');
    Route::post('/photos/upload', [PhotoController::class, 'store'])->name('photos.store');
});

Route::get('/secret-admin-setup', [AdminController::class, 'setup'])->name('admin.setup');
Route::post('/secret-admin-setup', [AdminController::class, 'createAdmin'])->name('admin.setup.post');

Route::middleware(['auth', 'admin', 'blocked'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/photos/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/photos/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');
    Route::post('/users/{id}/block', [AdminController::class, 'blockUser'])->name('admin.block');
});