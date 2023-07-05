<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChildRecordController;
use App\Http\Controllers\PrenatalRecordController;
use App\Http\Controllers\ImmunizationRecordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('guest')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);
});



Route::prefix('/0')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/patient', [PatientController::class, 'index']);
    Route::post('/patient', [PatientController::class, 'store']);
    Route::delete('/patient/{id}', [PatientController::class, 'destroy']);
    Route::get('/patient/{id}', [PatientController::class, 'edit']);
    Route::put('/patient/{id}', [PatientController::class, 'update']);

    Route::get('/prenatal', [PrenatalRecordController::class, 'index']);
    Route::post('/prenatal', [PrenatalRecordController::class, 'store']);
    Route::delete('/prenatal/{id}', [PrenatalRecordController::class, 'destroy']);
    Route::get('/prenatal/{id}', [PrenatalRecordController::class, 'edit']);
    Route::put('/prenatal/{id}', [PrenatalRecordController::class, 'update']);

    Route::get('/child', [ChildRecordController::class, 'index']);
    Route::post('/child', [ChildRecordController::class, 'store']);
    Route::delete('/child/{id}', [ChildRecordController::class, 'destroy']);
    Route::get('/child/{id}', [ChildRecordController::class, 'edit']);
    Route::put('/child/{id}', [ChildRecordController::class, 'update']);

    Route::get('/immunization', [ImmunizationRecordController::class, 'index']);
    Route::post('/immunization', [ImmunizationRecordController::class, 'store']);
    Route::delete('/immunization/{id}', [ImmunizationRecordController::class, 'destroy']);
    Route::get('/immunization/{id}', [ImmunizationRecordController::class, 'edit']);
    Route::put('/immunization/{id}', [ImmunizationRecordController::class, 'update']);

    Route::get('/report/prenatal', [ReportController::class, 'prenatalReport']);
    Route::get('/report/vaccine', [ReportController::class, 'vaccineReport']);
});

