<?php

declare(strict_types=1);

namespace App\Domain\User\Aggregate;

use App\Domain\Shared\ValueObjects\DateTimeValueObject;
use App\Domain\User\ValueObjects\Email;
use App\Domain\User\ValueObjects\Id;
use App\Domain\User\ValueObjects\Name;
use App\Domain\User\ValueObjects\Password;
use App\Domain\User\ValueObjects\Phone;
use App\Domain\User\ValueObjects\RoleId;

final class User
{
    private function __construct(
        private Email $email,
        private Name $name,
        private Phone $phone,
        private RoleId $roleId,
        private Password $password,
        private DateTimeValueObject $created_at,
        private ?DateTimeValueObject $updated_at,
        private ?Id $id = null
    ) {
    }

    public static function create(
        Email $email,
        Name $name,
        Phone $phone,
        RoleId $roleId,
        Password $password,
        DateTimeValueObject $created_at,
        ?DateTimeValueObject $updated_at = null,
        ?Id $id = null
    ): self {
        return new self(
            $email,
            $name,
            $phone,
            $roleId,
            $password,
            $created_at,
            $id,
            $updated_at
        );
    }

    public function id(): ?Id
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function phone(): Phone
    {
        return $this->phone;
    }

    public function roleId(): RoleId
    {
        return $this->roleId;
    }
    public function password(): Password
    {
        return $this->password;
    }

    public function createdAt(): DateTimeValueObject
    {
        return $this->created_at;
    }

    public function updatedAt(): ?DateTimeValueObject
    {
        return $this->updated_at;
    }

    public function updateName(string $name): void
    {
        $this->name = Name::fromString($name);
    }

    public function updatePhone(string $phone): void
    {
        $this->phone = Phone::fromString($phone);
    }

    public function updateRoleId(int $roleId): void
    {
        $this->roleId = RoleId::fromInteger($roleId);
    }

    public function updateEmail(string $email): void
    {
        $this->email = Email::fromString($email);
    }

    public function updatePassword(string $password): void
    {
        $this->password = Password::fromString($password);
    }

    public function asArray(): array
    {
        return [
            'id' => $this->id()?->value(),
            'email' => $this->email()->value(),
            'name' => $this->name()->value(),
            'phone' => $this->phone()->value(),
            'role_id' => $this->phone()->value(),
            'created_at' => $this->createdAt()->value(),
            'updated_at' => $this->updatedAt()?->value()
        ];
    }
}
