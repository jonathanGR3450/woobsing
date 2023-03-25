<?php

namespace App\UserInterface\Controller\Auth;

use App\Application\Auth\Contracts\AuthUserInterface;
use App\Infrastructure\Laravel\Controller;
use App\UserInterface\Requests\Auth\LoginFormRequest;
use App\UserInterface\Requests\Auth\RegisterFormRequest;

class AuthController extends Controller
{
    private AuthUserInterface $authUserInterface;
    public function __construct(AuthUserInterface $authUserInterface)
    {
        $this->middleware('auth', ['except' => ['loginPost','registration', 'registrationPost', 'index']]);
        $this->authUserInterface = $authUserInterface;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function loginPost(LoginFormRequest $request)
    {
        $login = $this->authUserInterface->loginCredentials($request->input('email'), $request->input('password'));
        if (!$login) {
            return redirect("login")->with('status', 'Oppes! You have entered invalid credentials');
        }

        return redirect()->intended('dashboard')
                    ->with('status', 'You have Successfully loggedin');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function registrationPost(RegisterFormRequest $request)
    {
        $user = $this->authUserInterface->createUser($request->input('name'), $request->input('email'), $request->input('password'));

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
