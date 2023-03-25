<?php

namespace App\UserInterface\Controller\Employees;

use App\Application\Employees\DisableEmployeeUseCase;
use App\Infrastructure\Laravel\Controller;

class DisableEmployeeController extends Controller
{

    private DisableEmployeeUseCase $disableEmployeeUseCase;

    public function __construct(DisableEmployeeUseCase $disableEmployeeUseCase) {
        $this->disableEmployeeUseCase = $disableEmployeeUseCase;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $id)
    {
        $this->disableEmployeeUseCase->__invoke($id);

        return redirect()->route('employees.index')->with('status', 'Employee disabled success!');
    }
}
