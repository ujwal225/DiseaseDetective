<?php

use App\Http\Controllers\DiseasePredictionController;
use App\Http\Controllers\Patient\AppointmentController;
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
Route::put('/doctor/profile/{id}', [\App\Http\Controllers\Doctor\DoctorController::class, 'update'])->name('doctor.update')->middleware('auth');



Route::get('/patient/dashboard', [\App\Http\Controllers\Patient\PatientController::class, 'homePage'])->name('patient.dashboard')->middleware('auth');
Route::get('/patient/preform', [\App\Http\Controllers\Patient\PatientController::class, 'preform'],)->name('patient.preform')->middleware('auth');
Route::post('/patient/predict-disease', [DiseasePredictionController::class, 'predict'])->name('patient.predict.disease');
Route::get('/patient/reqAppointment', [\App\Http\Controllers\Patient\PatientController::class, 'showAppointment'])->name('patient.reqAppointment')->middleware('auth');
Route::get('/patient/viewToken/{appointment_id}', [\App\Http\Controllers\Patient\PatientController::class, 'showToken'])->name('patient.showToken')->middleware('auth');
Route::delete('/patient/{id}/destroy', [\App\Http\Controllers\Patient\PatientController::class, 'destroy'])->name('patient.appointment.destroy')->middleware('auth');
Route::get('/patient/historyAppointment', [\App\Http\Controllers\Patient\PatientController::class, 'showHistoryAppointment'])->name('patient.historyAppointment')->middleware('auth');

Route::get('/patient/profile', [\App\Http\Controllers\Patient\PatientController::class, 'profile'])->name('patient.profile')->middleware('auth');
Route::get('/patient/profile/{id}/edit', [\App\Http\Controllers\Patient\PatientController::class, 'edit'])->name('patient.edit')->middleware('auth');
Route::put('/patient/profile/{id}', [\App\Http\Controllers\Patient\PatientController::class, 'update'])->name('patient.update')->middleware('auth');

Route::get('/doctor/schedule', [\App\Http\Controllers\Doctor\DoctorController::class, 'scheduleIndex'])->name('doctor.schedule')->middleware('auth');
Route::post('/doctor/scheduleStore', [\App\Http\Controllers\Doctor\DoctorController::class, 'schedule'])->name('doctor.schedule.store')->middleware('auth');
Route::delete('/doctor/schedule/{id}', [\App\Http\Controllers\Doctor\DoctorController::class, 'scheduleDelete'])->name('doctor.schedule.delete')->middleware('auth');
Route::get('/doctor/manageAppointment',[\App\Http\Controllers\Doctor\DoctorController::class, 'manageAppointmentsIndex'])->name('doctor.manageAppointment')->middleware('auth');
Route::get('/doctor/appointment_details/{id}',[\App\Http\Controllers\Doctor\DoctorController::class, 'appointmentDetails'])->name('doctor.appointment_details')->middleware('auth');
Route::patch('/doctor/appointment_details/{id}/approve', [\App\Http\Controllers\Doctor\DoctorController::class, 'approveAppointment'])->name('doctor.appointment_details.approve')->middleware('auth');
Route::get('/doctor/view_appointment', [\App\Http\Controllers\Doctor\DoctorController::class, 'appointmentIndex'])->name('doctor.view_appointment')->middleware('auth');


Route::get('/patient/{doctorId}/book_appointment', [\App\Http\Controllers\Patient\AppointmentController::class, 'showDoctorDetails'])->name('patient.book_appointment')->middleware('auth');
Route::get('/api/patient/available-slots/{doctorId}/{date}', [\App\Http\Controllers\Patient\AppointmentController::class, 'getAvailableSlots'])->name('patient.available.slots');
Route::post('/patient/book_appointment', [\App\Http\Controllers\Patient\AppointmentController::class, 'store'])->name('patient.book_appointment.store')->middleware('auth');



Route::get('/doctor/verifyToken', [\App\Http\Controllers\Doctor\DoctorController::class, 'viewVerifyToken'])->name('doctor.verifyToken')->middleware('auth');
Route::patch('/doctor/verifyToken/{id}/update', [\App\Http\Controllers\Doctor\DoctorController::class, 'updateVerifyToken'])->name('doctor.verifyToken.update')->middleware('auth');
