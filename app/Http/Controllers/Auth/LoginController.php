<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use http\Client\Curl\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


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

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $data = \App\Models\User::where($this->username(), $request->only($this->username()))->first();
        if (isset($data)) {
            if ($data->status == 1) {
                if($data->reset_psw == 1){
                    $email = $data->email;
                    return redirect()->route('password.index',$email);
                }else{

                    if ($this->attemptLogin($request)) {
                        return $this->sendLoginResponse($request);
                    }

                    // If the login attempt was unsuccessful we will increment the number of attempts
                    // to login and redirect the user back to the login form. Of course, when this
                    // user surpasses their maximum number of attempts they will get locked out.
                    $this->incrementLoginAttempts($request);

                    return $this->sendFailedLoginResponse($request);
                }
            }else{
                $errors = [$this->username() => trans('Usuário Inativo, favor entrar em contato com o Diretor')];

                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors($errors);
            }

        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function alterarSenhaIndex($email){
        return view('admin.user.resetChange', compact('email'));
    }

    public function alterarSenha(Request $request){
        $this->validate($request, [
            'email' => 'required | email | max:255',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);


        $data = \App\Models\User::where('email', $request->email)->first();
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->reset_psw = 0;
        $data->save();

        Auth::login($data);
        return redirect()->route('einstein.home');

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
