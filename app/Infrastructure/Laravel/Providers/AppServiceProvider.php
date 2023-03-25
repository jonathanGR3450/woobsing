<?php

namespace App\Infrastructure\Laravel\Providers;

use App\Application\Auth\AuthUser;
use App\Application\Auth\Contracts\AuthUserInterface;
use App\Domain\Employees\Aggregate\Employee;
use App\Domain\Employees\Contracts\EmployeeInterface;
use App\Domain\Employees\EmployeeRepositoryInterface;
use App\Domain\Employees\HistoryRepositoryInterface;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Employees\EmployeeRepository;
use App\Infrastructure\Employees\HistoryRepository;
use App\Infrastructure\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthUserInterface::class, AuthUser::class);
        $this->app->bind(EmployeeInterface::class, Employee::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(HistoryRepositoryInterface::class, HistoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
