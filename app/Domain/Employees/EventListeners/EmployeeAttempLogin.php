<?php

namespace App\Domain\Employees\EventListeners;

use App\Domain\Employees\Events\EmployeeSession;

class EmployeeAttempLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Domain\Employees\Events\EmployeeSession $event
     * @return void
     */
    public function handle(EmployeeSession $event)
    {
        $event->historyRepositoryInterface->create($event->history);
    }
}
