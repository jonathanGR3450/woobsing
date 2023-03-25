<?php

declare(strict_types=1);

namespace App\Application\Employees;

use App\Domain\Employees\EmployeeRepositoryInterface;
use App\Domain\Employees\ValueObjects\Id;

final class DisableEmployeeUseCase
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface) {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function __invoke(string $id): void
    {
        $employee = $this->employeeRepositoryInterface->findById(Id::fromPrimitives($id));
        $employee->updateHasAccess(!$employee->hasAccess()->value());
        $this->employeeRepositoryInterface->update($employee);
    }
}