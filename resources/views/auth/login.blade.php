@extends('auth.layouts._layout')
@section('title', 'Login')
@section('content')
    <div class="container-form ">
        <div class="d-flex align-items-center justify-content-center container mb-4">
            <img class="img-fluid login-logo" src="{{asset('img/thumbnail.png')}}" alt="">
        </div>
        <div class="card card-signin">
            <div class="card-body">
                <h5 class="card-title text-center">Iniciar Sesión</h5>
                <form class="form-signin" autocomplete="on" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-label-group">
                        <input id="email" type="text"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                            value="{{ old('email') }}" placeholder="Email" required>
                        <label for="email">Email</label>
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-label-group">
                        <input id="password" type="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            placeholder="contraseña">
                        <label for="password">Contraseña</label>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Recordar contraseña</label>
                    </div>
                    <button class="btn btn-lg btn-blue  btn-block text-uppercase" type="submit">Entrar</button>
                    <div class="text-center">
                        <a class="small" href="{{route('password.request')}}">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
        <span class="footer-login">Copyright &copy; Equibra 2019</span>
    </div>
@endsection
