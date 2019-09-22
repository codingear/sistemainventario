@extends('auth.layouts._layout')
@section('title', 'Reestablecer Contraseña')
@section('content')
    <div class="container-form">
        <div class="d-flex align-items-center justify-content-center container mb-4">
            <img class="img-fluid login-logo" src="{{asset('img/thumbnail.png')}}" alt="">
        </div>
        <div class="card card-signin">
            <div class="card-body">
                <h5 class="card-title text-center mb-3">Reestablecer contraseña</h5>
                <form class="form-signin" autocomplete="on" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-label-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        <label for="email">Email</label>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-label-group">
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                               required autocomplete="new-password">
                        <label for="password">Nueva contraseña</label>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-label-group">
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required autocomplete="new-password">
                        <label for="password-confirm">Confirmar nueva contraseña</label>
                    </div>
                    <button class="btn btn-lg btn-blue  btn-block text-uppercase" type="submit">Reestablecer
                        contraseña
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection


