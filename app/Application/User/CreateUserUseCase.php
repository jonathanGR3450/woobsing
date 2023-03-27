<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\Shared\ValueObjects\DateTimeValueObject;
use App\Domain\User\Aggregate\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObjects\Email;
use App\Domain\User\ValueObjects\Id;
use App\Domain\User\ValueObjects\Name;
use App\Domain\User\ValueObjects\Password;
use App\Domain\User\ValueObjects\Phone;
use App\Domain\User\ValueObjects\RoleId;

final class CreateUserUseCase
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface) {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function __invoke(string $name, string $email, string $phone, int $roleId, string $password): User
    {
        $user = User::create(
            Email::fromString($email),
            Name::fromString($name),
            Phone::fromString($phone),
            RoleId::fromInteger($roleId),
            Password::fromString($password),
            DateTimeValueObject::now()
        );

        $this->userRepositoryInterface->create($user);
        return $user;
    }
}