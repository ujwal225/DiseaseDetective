<?php

use App\Http\Controllers\DiseasePredictionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


Route::get('/admin/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'homePage'])->name('admin.dashboard')->middleware('auth');
Route::get('/admin/managedoctor', [\App\Http\Controllers\Admin\DoctorController::class, 'index'])->name('admin.managedoctor')->middleware('auth');
Route::get('/admin/{id}/approveindex', [\App\Http\Controllers\Admin\DoctorController::class, 'show'])->name('admin.approveindex')->middleware('auth');
Route::patch('/admin/{id}/approve', [\App\Http\Controllers\Admin\DoctorController::class, 'approve'])->name('admin.approve')->middleware('auth');
Route::get('/admin/workflow',[\App\Http\Controllers\Admin\DoctorController::class, 'workflow'])->name('admin.workflow')->middleware('auth');

Route::get('/admin/listdoctor',[\App\Http\Controllers\Admin\DoctorController::class, 'listdoctor'])->name('admin.listdoctor')->middleware('auth');
Route::delete('/admin/{id}/destroy', [\App\Http\Controllers\Admin\DoctorController::class, 'destroy'])->name('admin.destroy')->middleware('auth');

Route::get('/doctor/dashboard', [\App\Http\Controllers\Doctor\DoctorController::class, 'homePage'])->name('doctor.dashboard')->middleware('auth');
Route::get('/doctor/profile', [\App\Http\Controllers\Doctor\DoctorController::class, 'profile'])->name('doctor.profile')->middleware('auth');
Route::get('/doctor/profile/{id}/edit', [\App\Http\Controllers\Doctor\DoctorController::class, 'edit'])->name('doctor.edit')->middleware('auth');

Route::get('/patient/dashboard', [\App\Http\Controllers\Patient\PatientController::class, 'homePage'])->name('patient.dashboard')->middleware('auth');
Route::get('/patient/preform', [\App\Http\Controllers\Patient\PatientController::class, 'preform'],)->name('patient.preform')->middleware('auth');



Route::post('/patient/predict-disease', [DiseasePredictionController::class, 'predict'])->name('patient.predict.disease');
