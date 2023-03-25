<?php

declare(strict_types=1);

namespace App\Application\Employees;

use App\Domain\Employees\EmployeeRepositoryInterface;
use App\Domain\Employees\ValueObjects\Id;

final class DestroyEmployeeUseCase
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface) {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function __invoke(string $id): void
    {
        $user = $this->employeeRepositoryInterface->findById(Id::fromPrimitives($id));
        $this->employeeRepositoryInterface->delete($user);
    }
}