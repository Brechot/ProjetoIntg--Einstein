<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use http\Client\Curl\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::HOME;

    //Metodo de login utilizado pela biblioteca AuthenticatesUsers, estou subscrevendo o metodo de login para ver se a necessidade de restaurar senh

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if (Auth::attempt($this->credentials($request), $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->status == 0) {
                Auth::logout();
                return redirect('login')->with('error', 'Usuário inativo, entrar em contato com o administrador!');
            }

            if ($user->reset_psw) {
                $token = app('auth.password.broker')->createToken($user);
                return view('auth.passwords.reset')->with([
                    'token'             => $token,
                    'id'                => $user->id,
                    'email'             => $user->email,
                    'username'          => $user->username,
                    'password_old'      => $request->password,
                    'current_password'  => true,
                ]);
            }

            return redirect()->intended($this->redirectPath());
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
