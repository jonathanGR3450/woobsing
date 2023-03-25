<?php

declare(strict_types=1);

namespace App\Domain\Employees;

use App\Domain\Employees\Aggregate\Employee;
use App\Domain\Employees\Exception\EmployeeNotFoundException;
use App\Domain\Employees\ValueObjects\Id;
use App\Infrastructure\Laravel\Models\Employee as ModelsEmployee;

interface EmployeeRepositoryInterface
{
    public function create(Employee $employee): void;

    public function createManyEmployees(array $employees): void;

    public function update(Employee $employee): void;

    /**
     * @throws EmployeeNotFoundException
     */
    public function findById(Id $id): Employee;

    /**
     * @throws EmployeeNotFoundException
     */
    public function findByIdGetModel(Id $id): ModelsEmployee;

    public function searchById(Id $id): ?Employee;

    public function searchByCriteria(EmployeeSearchCriteria $criteria): array;

    public function getAllEmployees(): array;

    public function delete(Employee $employee): void;
}