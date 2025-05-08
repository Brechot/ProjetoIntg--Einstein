<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use http\Client\Curl\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


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

    //Metodo de login utilizado pela biblioteca AuthenticatesUsers, estou subscrevendo o metodo de login para ver se a necessidade de restaurar senha
    protected function authenticated(Request $request, $user) //ja traz o user pela função nativa
    {
        if ($user->status == 0){
            return redirect('login')->with('error', 'Usuário inativo, entrar em contato com o administrador!');
        }else{
        if ($user->reset_psw == true){

            $token = app('auth.password.broker')->createToken($user); //token necessário para realizar o reset da senha

            return view('auth.passwords.reset')->with([
                    'token'             => $token,
                    'id'                => $user->id,
                    'email'             => $user->email,
                    'username'          => $user->username,
                    'password_old'      => $request->password,
                    'current_password'  => true,
                ]
            );
        }
            return redirect()->intended($this->redirectTo);
        }
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
