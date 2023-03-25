<?php

declare(strict_types=1);

namespace App\Domain\Employees;

use App\Domain\Employees\Aggregate\History;
use App\Domain\Employees\ValueObjects\Id;

interface HistoryRepositoryInterface
{
    public function create(History $history): void;
    public function historyAttemptsLoginSearchByCriteria(Id $id, HistorySearchCriteria $criteria): array;
}