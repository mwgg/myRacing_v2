<?php

use App\Http\Controllers\PlannerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PlannerController::class, 'dashboard'])->name('dashboard');
Route::get('/planner', [PlannerController::class, 'planner'])->name('planner');
Route::view('/help', 'help')->name('help');
Route::view('/export', 'export')->name('export');
