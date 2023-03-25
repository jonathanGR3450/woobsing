<?php

use App\UserInterface\Controller\Auth\AuthController;
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

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('form-login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('form-registration', [AuthController::class, 'registrationPost'])->name('register.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('employee/form/login', 'Employees\EmployeeFrontController@loginEmployee')->name('employee.login.form');
Route::post('employee/login', 'Employees\LoginEmployeeController')->name('employee.login.post');
Route::group(['middleware' => 'auth'], function () {
    # module employees front
    Route::get('employee/form', 'Employees\EmployeeFrontController@create')->name('employee.create');
    Route::get('employee/csv', 'Employees\EmployeeFrontController@uploadCsv')->name('employee.upload.csv');

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
