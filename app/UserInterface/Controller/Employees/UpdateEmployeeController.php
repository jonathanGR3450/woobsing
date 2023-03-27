<?php

namespace App\UserInterface\Controller\Employees;

use App\Application\Employees\UpdateEmployeeUseCase;
use App\Infrastructure\Laravel\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

class UpdateEmployeeController extends Controller
{
    private UpdateEmployeeUseCase $updateEmployeeUseCase;

    public function __construct(UpdateEmployeeUseCase $updateEmployeeUseCase) {
        $this->updateEmployeeUseCase = $updateEmployeeUseCase;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $id)
    {
        $this->updateEmployeeUseCase->__invoke($request->input('first_name'), $request->input('last_name'), $request->input('department'), (bool) $request->input('has_access'), $id);

        return redirect()->route('employees.index')->with('status', 'Employee updated success!');
    }
}
