<?php

namespace App\UserInterface\Controller\Auth;

use App\Infrastructure\Laravel\Controller;
use App\Infrastructure\Laravel\Models\UserCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TwoFAController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.2fa.2fa');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);

        $find = UserCode::where('user_id', auth()->user()->id)
                        ->where('code', $request->code)
                        ->where('updated_at', '>=', now()->subMinutes(30))
                        ->first();

        if (is_null($find)) {
            return back()->with('error', 'You entered wrong code.');
        }
        $response = redirect()->route('dashboard')->with('status', 'You have Successfully loggedin');
        Session::put('user_2fa', auth()->user()->id);

        if (Auth::user()->role_id == 1 && $request->ip() == "172.20.0.1") {
            $response->withCookie(cookie('origin_sesion', Carbon::now(), 60));
        }

        return $response;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resend()
    {
        auth()->user()->generateCode();

        return back()->with('success', 'We sent you code on your email.');
    }
}
