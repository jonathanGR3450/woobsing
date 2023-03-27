<?php

declare(strict_types=1);

namespace App\Domain\Employees\Aggregate;

use App\Domain\Employees\Contracts\IntruderInterface;
use App\Domain\Employees\ValueObjects\Attempts;
use App\Domain\Employees\ValueObjects\Department;
use App\Domain\Employees\ValueObjects\FirstName;
use App\Domain\Employees\ValueObjects\HasAccess;
use App\Domain\Employees\ValueObjects\Id;
use App\Domain\Employees\ValueObjects\LastName;
use App\Domain\Shared\ValueObjects\DateTimeValueObject;

class Intruder extends Employee implements IntruderInterface
{

    public static function createIntruder(
        Id $id,
        ?DateTimeValueObject $created_at = null,
        ?DateTimeValueObject $updated_at = null,
        ?Attempts $attempts = null,
    ): Employee
    {
        return parent::create(
            FirstName::fromString('Intruder'),
            LastName::fromString('Intruder'),
            Department::fromString('Intruder'),
            HasAccess::fromBoolean(false),
            DateTimeValueObject::now(),
            $updated_at,
            $attempts,
            $id,
        );
    }
}