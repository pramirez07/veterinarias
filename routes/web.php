<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    
    Route::get('/clinicas', [ClinicaController::class, 'index'])->name('clinica.index');
    Route::get('/clinica/{id}', [ClinicaController::class, 'show'])->name('clinica.show');
    Route::get('/clinica', [ClinicaController::class, 'create'])->name('clinica.create');
    Route::post('/clinica', [ClinicaController::class, 'store'])->name('clinica.store');
    Route::get('/clinica/{id}/edit', [ClinicaController::class, 'edit'])->name('clinica.edit');
    Route::patch('/clinica', [ClinicaController::class, 'update'])->name('clinica.update');
    Route::delete('/clinica/{id}',[ClinicaController::class, 'destroy'])->name('clinica.destroy');

    Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleado.index');
    Route::get('/empleado/{id}', [EmpleadoController::class, 'show'])->name('empleado.show');
    Route::get('/empleado', [EmpleadoController::class, 'create'])->name('empleado.create');
    Route::post('/empleado', [EmpleadoController::class, 'store'])->name('empleado.store');
    Route::get('/empleado/{id}/edit', [EmpleadoController::class, 'edit'])->name('empleado.edit');
    Route::patch('/empleado', [EmpleadoController::class, 'update'])->name('empleado.update');
    Route::delete('/empleado/{id}',[EmpleadoController::class, 'destroy'])->name('empleado.destroy');
});

require __DIR__.'/auth.php';
