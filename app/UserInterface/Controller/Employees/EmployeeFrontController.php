<?php

namespace App\UserInterface\Controller\Employees;

use App\Domain\Employees\Aggregate\Employee;
use App\Infrastructure\Laravel\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

class EmployeeFrontController extends Controller
{
    // private CreateEmployeeUseCase $createEmployeeUsercase;

    // public function __construct(CreateEmployeeUseCase $createEmployeeUsercase) {
    //     $this->createEmployeeUsercase = $createEmployeeUsercase;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $employee = null;
        return view('employees.create', compact('employee'));
    }

    public function uploadCsv(Request $request)
    {
        return view('employees.upload-csv');
    }

    public function loginEmployee(Request $request)
    {
        return view('employees.login');
    }
}
