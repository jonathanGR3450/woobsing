<?php

declare(strict_types=1);

namespace App\Domain\Employees\Aggregate;

use App\Domain\Employees\ValueObjects\Attempts;
use App\Domain\Employees\ValueObjects\EmployeeId;
use App\Domain\Employees\ValueObjects\Id;
use App\Domain\Shared\ValueObjects\DateTimeValueObject;
use App\UserInterface\Presenter\Histories\HistoryPresenter;

final class History
{
    private function __construct(
        private Id $id,
        private EmployeeId $employee_id,
        private DateTimeValueObject $created_at,
        private ?DateTimeValueObject $updated_at
    ) {
    }

    public static function create(
        Id $id,
        EmployeeId $employee_id,
        DateTimeValueObject $created_at,
        ?DateTimeValueObject $updated_at = null,
    ): self {
        return new self(
            $id,
            $employee_id,
            $created_at,
            $updated_at,
        );
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function employeeId(): EmployeeId
    {
        return $this->employee_id;
    }


    public function createdAt(): DateTimeValueObject
    {
        return $this->created_at;
    }

    public function updatedAt(): ?DateTimeValueObject
    {
        return $this->updated_at;
    }

    public function attempts(): ?Attempts
    {
        return $this->attempts;
    }

    public function present(): HistoryPresenter
    {
        return new HistoryPresenter($this);
    }

    public function asArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'employee_id' => $this->employeeId()->value(),
            'created_at' => $this->createdAt()->value(),
            'updated_at' => $this->updatedAt()?->value(),
        ];
    }
}
