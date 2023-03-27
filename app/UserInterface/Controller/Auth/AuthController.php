<?php

namespace App\UserInterface\Controller\Auth;

use App\Application\Auth\Contracts\AuthUserInterface;
use App\Domain\Employees\Events\UserSession;
use App\Infrastructure\Laravel\Controller;
use App\Infrastructure\Laravel\Models\User;
use App\UserInterface\Requests\Auth\LoginFormRequest;
use App\UserInterface\Requests\Auth\RegisterFormRequest;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private AuthUserInterface $authUserInterface;
    public function __construct(AuthUserInterface $authUserInterface)
    {
        $this->middleware('auth', ['except' => ['loginPost','registration', 'registrationPost', 'index', 'verifyMail', 'verify']]);
        $this->authUserInterface = $authUserInterface;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function verify()
    {
        return view('auth.verify');
    }

    public function verifyMail(Request $request, int $id, string $hash)
    {
        $user = User::find($id);

        if (!hash_equals((string) $hash, $user->verification_token)) {
            throw new AuthorizationException("unauthorized");
        }

        $user->markEmailAsVerified();
 
        return redirect()->route("employees.index");
    }

    public function verifyResend()
    {
        $user = Auth::user();
        // dd($user);
        $user->verification_token = \Illuminate\Support\Str::random(40);
        $user->save();

        $user->sendEmailVerificationNotification();

        return redirect()->route("employees.index");
    }

    public function loginPost(LoginFormRequest $request)
    {
        $login = $this->authUserInterface->loginCredentials($request->input('email'), $request->input('password'));
        if (!$login) {
            return redirect("login")->with('status', 'Oppes! You have entered invalid credentials');
        }
        // event(new UserSession('origin_sesion', 'valor_cookie', 60));
        // dd(request()->cookie('origin_sesion'));

        $response = redirect()->intended('dashboard')->with('status', 'You have Successfully loggedin');

        if (Auth::user()->role_id == 1 && $request->ip() == "172.20.0.1") {
            $response->withCookie(cookie('origin_sesion', Carbon::now(), 60));
        }

        return $response;
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function registrationPost(RegisterFormRequest $request)
    {
        $user = $this->authUserInterface->createUser($request->input('name'), $request->input('email'), $request->input('phone'), $request->input('role_id'), $request->input('password'));

        return redirect("login")->with('status', 'You have signed-in');
    }

    public function logout()
    {
        $this->authUserInterface->logout();
        return Redirect('login');
    }

    public function dashboard()
    {
        if($this->authUserInterface->check()){
            return redirect()->route('employees.index')->with('status', 'You have signed-in');
        }
  
        return redirect("login")->with('status', 'You are not allowed to access');
    }
}
