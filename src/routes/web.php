<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AttendanceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
        Route::get('/', [AttendanceController::class, 'index']);
    });
Route::get('/attendance', [AttendanceController::class, 'date']);
Route::post('/attendance', [AttendanceController::class, 'date']);
Route::get('/attendance/{day}', [AttendanceController::class, 'changeDay'])->name('changeDay.show');
Route::post('/work-start', [AttendanceController::class, 'work_start']);
Route::post('/work-finish', [AttendanceController::class, 'work_finish']);
Route::post('/break-start', [AttendanceController::class, 'break_start']);
Route::post('/break-finish', [AttendanceController::class, 'break_finish']);