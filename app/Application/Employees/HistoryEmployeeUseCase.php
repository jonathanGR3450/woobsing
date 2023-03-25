<?php

declare(strict_types=1);

namespace App\Application\Employees;

use App\Domain\Employees\HistoryRepositoryInterface;
use App\Domain\Employees\HistorySearchCriteria;
use App\Domain\Employees\ValueObjects\Id;
use App\Domain\Shared\Model\CriteriaField;
use App\Domain\Shared\Model\CriteriaSort;
use App\Domain\Shared\Model\CriteriaSortDirection;

final class HistoryEmployeeUseCase
{
    private HistoryRepositoryInterface $historyRepositoryInterface;

    public function __construct(HistoryRepositoryInterface $historyRepositoryInterface)
    {
        $this->historyRepositoryInterface = $historyRepositoryInterface;
    }

    public function __invoke(string $id, ?int $offset = null, ?string $date_init = null, ?string $date_end = null): array
    {
        $criteria = HistorySearchCriteria::create($id, $offset, $date_init, $date_end);
        $criteria->sortBy(new CriteriaSort(CriteriaField::fromString('created_at'), CriteriaSortDirection::ASC));
        $histories = $this->historyRepositoryInterface->historyAttemptsLoginSearchByCriteria(Id::fromPrimitives($id), $criteria);

        return $histories;
    }
}
