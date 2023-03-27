<?php

declare(strict_types=1);

namespace App\Application\Employees;

use App\Domain\Employees\Contracts\EmployeeInterface;
use App\Domain\Employees\EmployeeRepositoryInterface;
use App\Domain\Employees\EmployeeSearchCriteria;
use App\Domain\Shared\Model\CriteriaField;
use App\Domain\Shared\Model\CriteriaSort;
use App\Domain\Shared\Model\CriteriaSortDirection;

final class IndexEmployeeUseCase
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface) {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function __invoke(?int $offset = null, ?string $first_name = null, ?string $last_name = null, ?string $department = null, ?bool $has_access = null, ?string $date_init = null, ?string $date_end = null, ?int $id = null): array
    {
        $criteria = EmployeeSearchCriteria::create($offset, $first_name, $last_name, $department, $has_access, $date_init, $date_end, $id);
        $criteria->sortBy(new CriteriaSort(CriteriaField::fromString('first_name'), CriteriaSortDirection::ASC));
        $users = $this->employeeRepositoryInterface->searchByCriteria($criteria);

        return array_map(fn (EmployeeInterface $user) => $user, $users);
    }
}