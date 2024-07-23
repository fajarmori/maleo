<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', Controllers\HomeController::class)->name('home');

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::get('/log', Controllers\LogController::class)->name('log');
        Route::get('/dashboard', Controllers\DashboardController::class)->name('dashboard');
        
        Route::resource('/sites', Controllers\SiteController::class);
        Route::resource('employees', Controllers\EmployeeController::class)->scoped(['employee' => 'slug']);
        Route::get('journeys/create/{employee:id}', [Controllers\JourneyController::class, 'create'])->name('journeys.create');
        Route::post('journeys/create/{employee:id}', [Controllers\JourneyController::class, 'store'])->name('journeys.store');
        Route::resource('journeys', Controllers\JourneyController::class)->except(['create','store','show']);
        Route::resource('occupations', Controllers\OccupationController::class)->except(['show']);
        Route::resource('departments', Controllers\DepartmentController::class)->except(['show']);
        Route::resource('droppoints', Controllers\DroppointController::class);
        Route::resource('deliverynotes', Controllers\DeliverynoteController::class);
        Route::get('deliveryitems/create/{deliverynote:id}', [Controllers\DeliveryitemController::class, 'create'])->name('deliveryitems.create');
        Route::post('deliveryitems/create/{deliverynote:id}', [Controllers\DeliveryitemController::class, 'store'])->name('deliveryitems.store');
        Route::resource('deliveryitems', Controllers\DeliveryitemController::class)->except(['create','store','show']);
        
        Route::get('/user', [Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('/user/{user}/edit', [Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{user}', [Controllers\UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{user}', [Controllers\UserController::class, 'destroy'])->name('user.destroy');
        
        Route::get('/profile', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
        
        Route::get('/scm', [Controllers\MenuController::class, 'scm'])->name('scm');
        Route::get('/hrd', [Controllers\MenuController::class, 'hrd'])->name('hrd');
        Route::get('/gait', [Controllers\MenuController::class, 'gait'])->name('gait');
        Route::get('/project', [Controllers\MenuController::class, 'project'])->name('project');
        Route::get('/application', [Controllers\MenuController::class, 'application'])->name('application');

        Route::get('/getemployees', [Controllers\DataController::class, 'getEmployees'])->name('getemployees');
        Route::get('/getemailsite', [Controllers\DataController::class, 'getEmailSite'])->name('getemailsite');
        Route::get('/getdroppoint', [Controllers\DataController::class, 'getDropPoint'])->name('getdroppoint');
        Route::get('/getdeliveryitem', [Controllers\DataController::class, 'getDeliveryItem'])->name('getdeliveryitem');
        
        Route::get('/deliverynotegenerate/{id}',[Controllers\DeliverynoteController::class, 'generateDeliveryNote'])->name('generateDeliveryNote');
    });
});

require __DIR__.'/auth.php';