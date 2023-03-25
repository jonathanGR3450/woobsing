<?php

declare(strict_types=1);

namespace App\Application\Employees;

use App\Domain\Employees\Aggregate\Employee;
use App\Domain\Employees\EmployeeRepositoryInterface;
use PDF;

final class PDFEmployeesUseCase
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface;
    private IndexEmployeeUseCase $indexEmployeeUseCase;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface, IndexEmployeeUseCase $indexEmployeeUseCase) {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
        $this->indexEmployeeUseCase = $indexEmployeeUseCase;
    }

    public function __invoke(?int $offset = null, ?string $first_name = null, ?string $last_name = null, ?string $department = null, ?bool $has_access = null, ?string $date_init = null, ?string $date_end = null, ?string $id = null): \Barryvdh\DomPDF\PDF
    {

        # para llamar el metodo invoke, es necesario llamarlo desde parentesis
        $employees = ($this->indexEmployeeUseCase)(
            $offset,
            $first_name,
            $last_name,
            $department,
            $has_access,
            $date_init,
            $date_end,
            $id,
        );
        $pdf = Employee::pdfEmployees($employees);
        return $pdf;
    }
}