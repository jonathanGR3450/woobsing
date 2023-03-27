<?php

namespace App\UserInterface\Controller\Employees;

use App\Application\Employees\DestroyEmployeeUseCase;
use App\Infrastructure\Laravel\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

class DestroyEmployeeController extends Controller
{

    private DestroyEmployeeUseCase $destroyEmployeeUseCase;

    public function __construct(DestroyEmployeeUseCase $destroyEmployeeUseCase) {
        $this->destroyEmployeeUseCase = $destroyEmployeeUseCase;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(int $id)
    {
        $this->destroyEmployeeUseCase->__invoke($id);

        return redirect()->route('employees.index')->with('status', 'Employee deleted success!');
    }
}
