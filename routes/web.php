<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', Controllers\HomeController::class)->name('home');

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::get('/log', Controllers\LogController::class)->name('log');
        Route::resource('/sites', Controllers\SiteController::class);
    });
    Route::get('/dashboard', Controllers\DashboardController::class)->name('dashboard');
    
    Route::resource('employees', Controllers\EmployeeController::class)->scoped(['employee' => 'slug']);
    Route::get('journeys/create/{employee:id}', [Controllers\JourneyController::class, 'create'])->name('journeys.create');
    Route::post('journeys/create/{employee:id}', [Controllers\JourneyController::class, 'store'])->name('journeys.store');
    Route::resource('journeys', Controllers\JourneyController::class)->except(['create','store','show']);
    Route::resource('occupations', Controllers\OccupationController::class)->except(['show']);
    Route::resource('departments', Controllers\DepartmentController::class)->except(['show']);
    
    Route::get('/profile', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
