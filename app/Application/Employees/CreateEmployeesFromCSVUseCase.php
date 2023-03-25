<?php

declare(strict_types=1);

namespace App\Application\Employees;

use App\Domain\Employees\Aggregate\Employee;
use App\Domain\Employees\EmployeeRepositoryInterface;

final class CreateEmployeesFromCSVUseCase
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface) {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function __invoke(string $path): void
    {
        $employees = Employee::employeesFromCSV($path);
        // dd($employees);

        $this->employeeRepositoryInterface->createManyEmployees($employees);
    }
}