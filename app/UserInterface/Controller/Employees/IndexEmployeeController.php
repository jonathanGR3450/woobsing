<?php

namespace App\UserInterface\Controller\Employees;

use App\Application\Employees\IndexEmployeeUseCase;
use App\Infrastructure\Laravel\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

class IndexEmployeeController extends Controller
{
    private IndexEmployeeUseCase $indexEmployeeUseCase;

    public function __construct(IndexEmployeeUseCase $indexEmployeeUseCase) {
        $this->indexEmployeeUseCase = $indexEmployeeUseCase;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $offset = (int) $request->query('offset');
        $first_name = $request->query('first_name');
        $last_name = $request->query('last_name');
        $department = $request->query('department');
        $has_access = $request->query('has_access');
        $date_init = $request->query('date_init');
        $date_end = $request->query('date_end');
        $id = $request->query('id');

        $employees = $this->indexEmployeeUseCase->__invoke(
            $offset,
            $first_name,
            $last_name,
            $department,
            $has_access,
            $date_init,
            $date_end,
            $id,
        );

        return view('dashboard', compact('employees', 'first_name', 'last_name', 'department', 'has_access', 'date_init', 'date_end', 'id'));
    }
}
