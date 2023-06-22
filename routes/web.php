<?php

use App\Http\Controllers\PlannerController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PlannerController::class, 'dashboard'])->name('dashboard');
Route::get('/planner', [PlannerController::class, 'planner'])->name('planner');
Route::get('/stats', [StatsController::class, 'stats'])->name('stats');
Route::view('/help', 'help')->name('help');
Route::view('/export', 'export')->name('export');
