<?php

declare(strict_types=1);

namespace App\Application\Employees;

use App\Domain\Employees\Aggregate\Employee;
use App\Domain\Employees\EmployeeRepositoryInterface;
use App\Domain\Employees\ValueObjects\Department;
use App\Domain\Employees\ValueObjects\FirstName;
use App\Domain\Employees\ValueObjects\HasAccess;
use App\Domain\Employees\ValueObjects\Id;
use App\Domain\Employees\ValueObjects\LastName;
use App\Domain\Shared\ValueObjects\DateTimeValueObject;

final class CreateEmployeeUseCase
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface) {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function __invoke(string $first_name, string $last_name, string $department, bool $has_access): Employee
    {
        $employ = Employee::create(
            Id::random(),
            FirstName::fromString($first_name),
            LastName::fromString($last_name),
            Department::fromString($department),
            HasAccess::fromBoolean($has_access),
            DateTimeValueObject::now()
        );

        $this->employeeRepositoryInterface->create($employ);
        return $employ;
    }
}