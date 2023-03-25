<?php

namespace App\UserInterface\Controller\Employees;

use App\Application\Employees\ShowEmployeeUseCase;
use App\Infrastructure\Laravel\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

class ShowEmployeeController extends Controller
{
    private ShowEmployeeUseCase $showEmployeeUseCase;

    public function __construct(ShowEmployeeUseCase $showEmployeeUseCase) {
        $this->showEmployeeUseCase = $showEmployeeUseCase;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $employee = $this->showEmployeeUseCase->__invoke($id);
        return view('employees.edit', compact('employee'));
    }
}
