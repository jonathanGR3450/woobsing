<?php

namespace App\Domain\Employees\Events;

use App\Domain\Employees\Aggregate\History;
use App\Domain\Employees\HistoryRepositoryInterface;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmployeeSession
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public History $history;
    public HistoryRepositoryInterface $historyRepositoryInterface;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(History $history, HistoryRepositoryInterface $historyRepositoryInterface)
    {
        $this->history = $history;
        $this->historyRepositoryInterface = $historyRepositoryInterface;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
