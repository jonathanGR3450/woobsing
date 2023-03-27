<?php

declare(strict_types=1);

namespace App\Domain\Employees\Aggregate;

use App\Domain\Employees\Contracts\EmployeeInterface;
use App\Domain\Employees\ValueObjects\Attempts;
use App\Domain\Employees\ValueObjects\Department;
use App\Domain\Employees\ValueObjects\FirstName;
use App\Domain\Employees\ValueObjects\HasAccess;
use App\Domain\Employees\ValueObjects\Id;
use App\Domain\Employees\ValueObjects\LastName;
use App\Domain\Shared\ValueObjects\DateTimeValueObject;
use App\UserInterface\Presenter\Employees\EmployeePresenter;
use PDF;

class Employee implements EmployeeInterface
{
    private function __construct(
        private FirstName $first_name,
        private LastName $last_name,
        private Department $department,
        private HasAccess $has_access,
        private DateTimeValueObject $created_at,
        private ?DateTimeValueObject $updated_at = null,
        private ?Attempts $attempts,
        private ?Id $id = null,
    ) {
    }

    public static function create(
        FirstName $first_name,
        LastName $last_name,
        Department $department,
        HasAccess $has_access,
        DateTimeValueObject $created_at,
        ?DateTimeValueObject $updated_at = null,
        ?Attempts $attempts = null,
        ?Id $id = null,
    ): self {
        return new self(
            $first_name,
            $last_name,
            $department,
            $has_access,
            $created_at,
            $updated_at,
            $attempts,
            $id
        );
    }

    public static function employeesFromCSV(string $path): array
    {
        $csv = array_map('str_getcsv', file($path));
        array_walk($csv, function (&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        array_shift($csv); # remove column header
        return $csv;
    }

    public static function attempt(?Employee $employee = null): bool
    {
        if (!$employee) {
            return false;
        }
        if (!$employee->has_access) {
            return false;
        }
        return true;
    }

    public static function pdfEmployees(array $employees): \Barryvdh\DomPDF\PDF
    {
        $pdf = PDF::loadView('pdf.downloadReport', compact('employees'));
        return $pdf;
    }

    public function id(): ?Id
    {
        return $this->id;
    }

    public function firstName(): FirstName
    {
        return $this->first_name;
    }

    public function lastName(): LastName
    {
        return $this->last_name;
    }

    public function department(): Department
    {
        return $this->department;
    }

    public function hasAccess(): HasAccess
    {
        return $this->has_access;
    }

    public function updateDepartment(string $department): void
    {
        $this->department = Department::fromString($department);
    }

    public function updateHasAccess(bool $has_access): void
    {
        $this->has_access = HasAccess::fromBoolean($has_access);
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

    public function updateFirstName(string $first_name): void
    {
        $this->first_name = FirstName::fromString($first_name);
    }

    public function updateLastName(string $last_name): void
    {
        $this->last_name = LastName::fromString($last_name);
    }

    public function employeeLoginAttempt(): void
    {
        // register attempt login employee
    }

    public function present(): EmployeePresenter
    {
        return new EmployeePresenter($this);
    }

    public function asArray(): array
    {
        return [
            'id' => $this->id()?->value(),
            'first_name' => $this->firstName()->value(),
            'last_name' => $this->lastName()->value(),
            'department' => $this->department()->value(),
            'has_access' => $this->hasAccess()->value(),
            'created_at' => $this->createdAt()->value(),
            'updated_at' => $this->updatedAt()?->value(),
            'attemps' => $this->attempts()?->value(),
        ];
    }
}
