<?php

namespace App\Domain\Employees\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserSession
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nombre;
    public $valor;
    public $duracion;

    public function __construct($nombre, $valor, $duracion)
    {
        $this->nombre = $nombre;
        $this->valor = $valor;
        $this->duracion = $duracion;
    }

}
