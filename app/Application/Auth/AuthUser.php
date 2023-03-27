<?php

declare(strict_types=1);

namespace App\Application\Auth;

use App\Application\Auth\Contracts\AuthUserInterface;
use App\Application\User\CreateUserUseCase;
use App\Domain\User\Aggregate\User;
use App\Domain\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\UnauthorizedException;

final class AuthUser implements AuthUserInterface
{
    private UserRepositoryInterface $userRepositoryInterface;
    private CreateUserUseCase $createUserUseCase;

    public function __construct(UserRepositoryInterface $userRepositoryInterface, CreateUserUseCase $createUserUseCase) {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->createUserUseCase = $createUserUseCase;
    }
    
    public function loginCredentials(string $email, string $password): bool
    {
        $credentials = compact('email', 'password');
        if (Auth::attempt($credentials)) {
            return true;
        }
        return false;
    }

    public function loginUserModel(User $user): string
    {
        $user = $this->userRepositoryInterface->findByIdGetModel($user->id());
        return '';
    }

    public function createUser(string $name, string $email, string $phone, int $roleId, string $password): User
    {
        $user = $this->createUserUseCase->__invoke($name, $email, $phone, $roleId, $password);
        return $user;
    }

    public function logout(): void
    {
        Session::flush();
        Auth::logout();
    }

    public function check(): bool
    {
        return Auth::check();
    }
}
