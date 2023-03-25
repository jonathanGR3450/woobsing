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

interface IntruderInterface extends EmployeeInterface
{
    public static function createIntruder(
        Id $id,
        ?DateTimeValueObject $created_at = null,
        ?DateTimeValueObject $updated_at = null,
        ?Attempts $attempts = null,
    ): Employee;

}