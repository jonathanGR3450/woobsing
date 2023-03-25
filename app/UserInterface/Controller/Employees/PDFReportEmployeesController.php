<?php

namespace App\UserInterface\Controller\Employees;

use App\Application\Employees\PDFEmployeesUseCase;
use App\Infrastructure\Laravel\Controller;
use App\Infrastructure\Laravel\Models\Employee;
use Illuminate\Http\Request;

class PDFReportEmployeesController extends Controller
{
    private PDFEmployeesUseCase $pdfEmployeesUseCase;

    public function __construct(PDFEmployeesUseCase $pdfEmployeesUseCase) {
        $this->pdfEmployeesUseCase = $pdfEmployeesUseCase;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $pdf = $this->pdfEmployeesUseCase->__invoke(
            (int) $request->query('offset'),
            $request->query('first_name'),
            $request->query('last_name'),
            $request->query('department'),
            $request->query('has_access'),
            $request->query('date_init'),
            $request->query('date_end'),
            $request->query('id'),
        );
        return $pdf->download('pdf_file.pdf');
    }
}
