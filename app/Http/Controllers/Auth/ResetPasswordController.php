<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    protected $redirectTo = RouteServiceProvider::HOME;
// Parei aqui, o laravel nao esta reconhecendo minha função abaixo
    public function reset(Request $request)
    {
//        $request->validate($this->rules(), $this->validationErrorMessages());

        $response = Password::reset(
            $this->credentials($request),
            function ($user, $password) use ($request) {
                // Aqui é onde você define manualmente a senha e o campo reset_psw
                $user->password = bcrypt($password);
                $user->reset_psw = 0;
                $user->setRememberToken(Str::random(60));
                $user->save();

                $this->guard()->login($user);
            }
        );
        return $response == Password::PASSWORD_RESET
            ? redirect($this->redirectPath())->with('status', __($response))
            : back()->withErrors(['email' => __($response)]);
    }

    protected function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }

    protected function validationErrorMessages(): array
    {
        return [
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Digite um e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ];
    }
}
