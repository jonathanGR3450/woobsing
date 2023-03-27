<?php

namespace App\Domain\Employees\EventListeners;

use App\Domain\Employees\Events\UserSession;
use Illuminate\Http\Response;

class UserLogin
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
     * @param  \App\Domain\Employees\Events\UserSession $event
     * @return void
     */
    public function handle($event)
    {
        $respuesta = new Response('Cookie creada');
        $respuesta->withCookie(cookie($event->nombre, $event->valor, $event->duracion));
        return $respuesta;
    }
}
