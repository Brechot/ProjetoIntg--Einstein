@extends('layouts.login')

@section('content')

    <div class="bodylogin">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <!-- Imagem à esquerda -->
                <div class="col-md-6 p-0 d-none d-md-block">
                    <img src="{{ asset('img/ImagemLogin.png') }}" alt="Imagem de pessoas usando computador" class="left-image">
                </div>

                <!-- Formulário de Login -->
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="login-container text-center" style="width: 100%; max-width: 600px;">
                        <div class="d-flex flex-column justify-content-center h-100">
                            <h2 class="fw-bold mb-3" style="text-decoration: underline; font-size: 1.8rem;">LOGIN</h2>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3 text-start">
                                    <label for="email" class="form-label small">E-mail</label>
                                    <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="mb-3 text-start">
                                    <label for="password" class="form-label small">Senha</label>
                                    <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback small" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-login btn-sm w-100 fw-semibold fs-6 mt-3">Acessar</button>

                                <div class="row pt-2 small">
                                    <div class="col-6 text-start">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                Lembrar senha
                                            </label>
                                        </div>
                                    </div>
{{--                                    <div class="col-6 text-end">--}}
{{--                                        @if (Route::has('password.request'))--}}
{{--                                            <a class="btn btn-link p-0 small" href="{{ route('password.request') }}">--}}
{{--                                                Esqueceu a senha?--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
