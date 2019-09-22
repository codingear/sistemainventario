@extends('auth.layouts._layout')
@section('title', 'Recupear Contraseña')
@section('content')
    <div class="container-form">
        <div class="d-flex align-items-center justify-content-center container mb-4">
            <img class="img-fluid login-logo" src="{{asset('img/thumbnail.png')}}" alt="">
        </div>
        <div class="card card-signin">
            <div class="card-body">
                <h5 class="card-title text-center mb-3">¿Olvidaste tu contraseña?</h5>
                <p class="text-center">Ingresa tu email y te enviaremos un enlace para reestablecer tu contraseña.</p>
                <form class="form-signin" autocomplete="on" method="POST" action="{{ route('password.email') }}">
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
                    <button class="btn btn-lg btn-blue  btn-block text-uppercase" type="submit">Enviar enlace de
                        reestablecimiento
                    </button>
                    @if (session('status'))
                        <p class="text-success mt-3 font-weight-bold text-center text-alert">
                            {{ session('status') }}
                        </p>
                    @endif
                </form>
            </div>
        </div>
        <span class="footer-login">Copyright &copy; Equibra 2019</span>
    </div>

@endsection
@push('optional_scripts')
    <script>
        window.setTimeout(function () {
            $(".text-alert").fadeTo(600, 0).slideUp(600, function () {
                $(this).remove();
            });
        }, 2500);
    </script>
@endpush
