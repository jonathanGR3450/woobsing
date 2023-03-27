<?php

declare(strict_types=1);

namespace App\Application\Employees;

use App\Domain\Employees\Aggregate\Employee;
use App\Domain\Employees\Aggregate\History;
use App\Domain\Employees\EmployeeRepositoryInterface;
use App\Domain\Employees\Events\EmployeeSession;
use App\Domain\Employees\HistoryRepositoryInterface;
use App\Domain\Employees\ValueObjects\EmployeeId;
use App\Domain\Employees\ValueObjects\Id;
use App\Domain\Shared\ValueObjects\DateTimeValueObject;

final class LoginEmployeeUseCase
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface;
    private HistoryRepositoryInterface $historyRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface, HistoryRepositoryInterface $historyRepositoryInterface) {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
        $this->historyRepositoryInterface = $historyRepositoryInterface;
    }

    public function __invoke(int $id): bool
    {
        $history = History::create(
            EmployeeId::fromInteger($id),
            DateTimeValueObject::now()
        );
        // dd($history);
        # event domain atempt login employee
        event(new EmployeeSession($history, $this->historyRepositoryInterface));
        $employee = $this->employeeRepositoryInterface->searchById(Id::fromInteger($id));
        return Employee::attempt($employee);
    }
}