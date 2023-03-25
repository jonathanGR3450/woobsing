<?php

namespace App\UserInterface\Controller\Employees;

use App\Application\Employees\CreateEmployeesFromCSVUseCase;
use App\Infrastructure\Laravel\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

class CreateEmployeesFromCSVController extends Controller
{
    private CreateEmployeesFromCSVUseCase $createEmployeesFromCSVUseCase;

    public function __construct(CreateEmployeesFromCSVUseCase $createEmployeesFromCSVUseCase) {
        $this->createEmployeesFromCSVUseCase = $createEmployeesFromCSVUseCase;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $path = $request->file('csv_file')->getRealPath();

        $this->createEmployeesFromCSVUseCase->__invoke($path);

        return redirect()->route('employees.index')->with('status', "Employees was upload successfull!");
    }
}
