<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PublicEmployeeController;
use App\Http\Controllers\AdminController;

// Strona główna
Route::get('/', function () {
    return view('welcome'); // Strona powitalna
})->name('home');

// Logowanie i wylogowanie
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login-form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rejestracja użytkownika
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register-form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Panel administratora
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard'); // Dodanie głównego widoku dla panelu admina
    Route::get('/admin/employees', [AdminController::class, 'manageEmployees'])->name('admin.employees');
    Route::post('/admin/employees', [AdminController::class, 'addEmployee'])->name('admin.employees.add');
    Route::delete('/admin/employees/{id}', [AdminController::class, 'deleteEmployee'])->name('admin.employees.delete');
    Route::get('/admin/appointments', [AppointmentController::class, 'index'])->name('admin.appointments');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::get('/admin/add-employee', [AdminController::class, 'addEmployeeView'])->name('admin.add-employee');
    Route::post('/admin/employees', [AdminController::class, 'storeEmployee'])->name('admin.employees.store');
    Route::delete('/admin/employees/{id}', [AdminController::class, 'destroyEmployee'])->name('admin.employees.destroy');

});

// Panel pracownika
Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.dashboard');
    Route::get('/employee/appointments', [EmployeeController::class, 'showAppointments'])->name('employee.appointments');
    Route::delete('/employee/appointments/{appointment}', [EmployeeController::class, 'destroyAppointment'])->name('employee.appointments.destroy');
});

// Panel klienta
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('/client/appointments', [ClientController::class, 'showAppointments'])->name('client.appointments.index');
    Route::get('/client/appointments/create', [ClientController::class, 'createAppointment'])->name('client.appointments.create');
    Route::post('/client/appointments/store', [ClientController::class, 'storeAppointment'])->name('client.appointments.store');
    Route::delete('/client/appointments/{appointment}', [ClientController::class, 'destroyAppointment'])->name('client.appointments.destroy');
});

// Publiczna lista pracowników
Route::get('/employees', [PublicEmployeeController::class, 'index'])->name('employees.index');

// Ogólnodostępne API
Route::get('/users', [UserController::class, 'index'])->name('api.users');
Route::get('/services', [ServiceController::class, 'index'])->name('api.services');
