<?php

declare(strict_types=1);

namespace App\Domain\Employees;

use App\Domain\Shared\Model\Criteria;
use App\Domain\Shared\Model\CriteriaPagination;

final class HistorySearchCriteria extends Criteria
{
    public const PAGINATION_SIZE = 10;

    private ?string $date_init = null;
    private ?string $date_end = null;

    public static function create(int $id, ?int $offset = null, ?string $date_init, ?string $date_end): HistorySearchCriteria
    {
        $criteria = new self(
            CriteriaPagination::create(self::PAGINATION_SIZE, $offset)
        );

        if (!empty($date_init)) {
            $criteria->date_init = $date_init;
        }

        if (!empty($date_end)) {
            $criteria->date_end = $date_end;
        }

        return $criteria;
    }

    public function dateInit(): ?string
    {
        return $this->date_init;
    }

    public function dateEnd(): ?string
    {
        return $this->date_end;
    }
}