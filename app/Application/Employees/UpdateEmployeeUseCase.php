<?php

declare(strict_types=1);

namespace App\Application\Employees;

use App\Domain\Employees\Aggregate\Employee;
use App\Domain\Employees\EmployeeRepositoryInterface;
use App\Domain\Employees\ValueObjects\Id;

final class UpdateEmployeeUseCase
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface) {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function __invoke(string $first_name, string $last_name, string $department, bool $has_access, int $id): Employee
    {
        $employee = $this->employeeRepositoryInterface->findById(Id::fromInteger($id));

        if($first_name){
            $employee->updateFirstName($first_name);
        }

        if($last_name){
            $employee->updateLastName($last_name);
        }

        if($department){
            $employee->updateDepartment($department);
        }

        if(isset($has_access)){
            $employee->updateHasAccess($has_access);
        }

        $this->employeeRepositoryInterface->update($employee);

        return $employee;
    }
}