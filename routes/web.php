<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\InsuranceController;

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
    // Route::get('divisions', [DivisionController::class, 'index'])->name('divisions.index');
    Route::resource('divisions', DivisionController::class)->except(['show']);
    Route::resource('clusters', ClusterController::class)->except(['show']);
    Route::resource('positions', PositionController::class)->except(['show']);
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::resource('employees', EmployeeController::class)->except(['index']);
    Route::resource('/insurances', InsuranceController::class)->except(['show']);
});

require __DIR__ . '/auth.php';
