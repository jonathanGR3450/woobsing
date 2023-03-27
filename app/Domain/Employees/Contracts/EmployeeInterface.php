<?php

// declare(strict_types=1);

namespace App\Domain\Employees\Contracts;

use App\Domain\Employees\Aggregate\Employee;
use App\Domain\Employees\ValueObjects\Attempts;
use App\Domain\Employees\ValueObjects\Department;
use App\Domain\Employees\ValueObjects\FirstName;
use App\Domain\Employees\ValueObjects\HasAccess;
use App\Domain\Employees\ValueObjects\Id;
use App\Domain\Employees\ValueObjects\LastName;
use App\Domain\Shared\ValueObjects\DateTimeValueObject;
use App\UserInterface\Presenter\Employees\EmployeePresenter;

interface EmployeeInterface
{
    public static function create(
        FirstName $first_name,
        LastName $last_name,
        Department $department,
        HasAccess $has_access,
        DateTimeValueObject $created_at,
        ?DateTimeValueObject $updated_at = null,
        ?Attempts $attempts = null,
        ?Id $id = null
    ): self;

    public function id(): ?Id;
    public function firstName(): FirstName;
    public function lastName(): LastName;
    public function department(): Department;
    public function hasAccess(): HasAccess;
    public function createdAt(): DateTimeValueObject;
    public function updatedAt(): ?DateTimeValueObject;

    public function updateFirstName(string $first_name): void;
    public function updateLastName(string $first_name): void;
    public function updateDepartment(string $department): void;
    public function updateHasAccess(bool $has_access): void;
    public function employeeLoginAttempt(): void;
    public function present(): EmployeePresenter;
    public static function attempt(?Employee $employee = null): bool;
    public static function employeesFromCSV(string $path): array;
    public function asArray(): array;


}