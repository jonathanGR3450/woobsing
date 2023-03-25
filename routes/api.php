<?php

use App\UserInterface\Controller\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user','Auth\AuthController@getAuthenticatedUser');
Route::post('users', 'User\CreateUserController');
Route::put('users/{id}', 'User\UpdateUserController');
Route::get('users/{id}', 'User\ShowUserController');
Route::delete('users/{id}', 'User\DestroyUserController');
Route::get('users', 'User\IndexUserController');


# module employees
Route::get('employeesreport', 'Employees\PDFReportEmployeesController');
Route::post('employeescsv', 'Employees\CreateEmployeesFromCSVController');
Route::post('employees', 'Employees\CreateEmployeeController');
Route::put('employees/{id}', 'Employees\UpdateEmployeeController');
Route::get('employees/{id}', 'Employees\ShowEmployeeController');
Route::delete('employees/{id}', 'Employees\DestroyEmployeeController');
Route::get('employees', 'Employees\IndexEmployeeController');
