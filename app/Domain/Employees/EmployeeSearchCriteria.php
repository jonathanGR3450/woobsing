<?php

declare(strict_types=1);

namespace App\Domain\Employees;

use App\Domain\Shared\Model\Criteria;
use App\Domain\Shared\Model\CriteriaPagination;

final class EmployeeSearchCriteria extends Criteria
{
    public const PAGINATION_SIZE = 10;

    private ?string $first_name = null;
    private ?string $last_name = null;
    private ?string $date_init = null;
    private ?string $date_end = null;
    private ?string $department = null;
    private ?bool $has_access = null;
    private ?string $id = null;

    public static function create(?int $offset = null, ?string $first_name = null, ?string $last_name = null, ?string $department, ?bool $has_access, ?string $date_init, ?string $date_end, ?string $id): EmployeeSearchCriteria
    {
        $criteria = new self(
            CriteriaPagination::create(self::PAGINATION_SIZE, $offset)
        );

        if (!empty($first_name)) {
            $criteria->first_name = $first_name;
        }

        if (!empty($id)) {
            $criteria->id = $id;
        }

        if (!empty($last_name)) {
            $criteria->last_name = $last_name;
        }

        if (!empty($date_init)) {
            $criteria->date_init = $date_init;
        }

        if (!empty($date_end)) {
            $criteria->date_end = $date_end;
        }

        if (!empty($department)) {
            $criteria->department = $department;
        }

        if (!is_null($has_access)) {
            $criteria->has_access = $has_access;
        }

        return $criteria;
    }

    public function id(): ?string
    {
        return $this->id;
    }

    public function firstName(): ?string
    {
        return $this->first_name;
    }

    public function lastName(): ?string
    {
        return $this->last_name;
    }

    public function department(): ?string
    {
        return $this->department;
    }

    public function hasAccess(): ?bool
    {
        return $this->has_access;
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