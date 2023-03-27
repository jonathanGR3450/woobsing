<?php

use App\UserInterface\Controller\Auth\AuthController;
use App\UserInterface\Controller\Auth\TwoFAController;
use Illuminate\Support\Facades\Route;

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

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('2fa', [TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa', [TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [TwoFAController::class, 'resend'])->name('2fa.resend');

Route::get('verify', [AuthController::class, 'verify'])->name('verify');
Route::post('verify-resend', [AuthController::class, 'verifyResend'])->name('verification.resend');
Route::get('verify-email/{id}/{hash}', [AuthController::class, 'verifyMail'])->name('verify.mail');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('form-login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('form-registration', [AuthController::class, 'registrationPost'])->name('register.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('employee/form/login', 'Employees\EmployeeFrontController@loginEmployee')->name('employee.login.form');
Route::post('employee/login', 'Employees\LoginEmployeeController')->name('employee.login.post');
Route::middleware(['auth', 'verified', 'lastsession', '2fa'])->group(function () {
    # module employees front
    Route::get('employee/form', 'Employees\EmployeeFrontController@create')->name('employee.create');
    Route::get('employee/csv', 'Employees\EmployeeFrontController@uploadCsv')->name('employee.upload.csv');

    Route::get('sessions', 'Employees\IndexSessionsController')->name('employees.sessions');
    Route::get('employees', 'Employees\IndexEmployeeController')->name('employees.index');
    Route::get('employees/{id}', 'Employees\ShowEmployeeController')->name('employee.edit');
    Route::get('employees/history/{id}', 'Employees\HistoryEmployeeController')->name('employee.history');
    Route::put('employees/{id}', 'Employees\UpdateEmployeeController')->name('employee.update');
    Route::delete('employees/{id}', 'Employees\DestroyEmployeeController')->name('employee.destroy');
    Route::post('employees', 'Employees\CreateEmployeeController')->name('employee.store');
    Route::post('employees/disabled/{id}', 'Employees\DisableEmployeeController')->name('employee.disabled');

    # module employees back
    Route::get('employeesreport', 'Employees\PDFReportEmployeesController')->name('employee.pdf');
    Route::post('employeescsv', 'Employees\CreateEmployeesFromCSVController')->name('employee.csv');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
