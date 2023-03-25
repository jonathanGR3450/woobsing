<?php

namespace App\UserInterface\Controller\Employees;

use App\Application\Employees\LoginEmployeeUseCase;
use App\Infrastructure\Laravel\Controller;
use Illuminate\Http\Request;

class LoginEmployeeController extends Controller
{
    private LoginEmployeeUseCase $loginEmployeeUseCase;

    public function __construct(LoginEmployeeUseCase $loginEmployeeUseCase) {
        $this->loginEmployeeUseCase = $loginEmployeeUseCase;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $employee = $this->loginEmployeeUseCase->__invoke($request->input('id'));
        if (!$employee) {
            return redirect()->route('employee.login.form')->with('status', 'Credentials not valid!');
        }
        return redirect()->route('employee.login.form')->with('status', 'Employee login successfull!');
    }
}
