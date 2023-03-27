<?php

namespace App\Infrastructure\Laravel\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;

class VerifieLastSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $lastSession = $user->last_session;
        $user->last_session = Carbon::now();
        $user->save();

        if (!$lastSession && $lastSession->diffInDays(Carbon::now()) >= 1) {
            return $request->expectsJson()
                        ? abort(403, 'Error')
                        : redirect()->route('employees.sessions');
        }

        return $next($request);
    }
}
