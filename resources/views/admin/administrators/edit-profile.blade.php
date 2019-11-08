@extends('admin.layouts._layout')
@section('title', 'Mi Perfil')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('admin.profile')}}">Mis Datos</a></li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Editar</li>
            </ol>
        </nav>
    </div>
    {{--    Page Heading--}}
    <div class="card shadow mb-4 mt-2 border-bottom-main">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-main">Editar mis datos</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form enctype="multipart/form-data" class="form-course needs-validation" id="editProfileForm" novalidate
                  method="POST"
                  action={{route('admin.updateAdminProfile')}}
                      autocomplete="off" role="form">
                @csrf
                @method('PUT')
                <div class="row align-items-center ">
                    <div class="col-12">
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-12">
                                <label for="name" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :'' }}"
                                       value="{{!empty($user) ? $user->name: ''}}" id="name"
                                       name="name">
                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' :'' }}"
                                       value="{{!empty($user) ? $user->email: ''}}" id="email"
                                       name="email">

                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                                <label for="password" class="col-form-label">Contraseña:</label>
                                <input type="password"
                                       class="form-control {{$errors->has('password') ? 'is-invalid' :'' }}"
                                       value="{{old('password')}}" id="password" name="password">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-lg-6 col-md-12">
                                <label for="password_confirmation" class="col-form-label">Confirmar
                                    contraseña:</label>
                                <input type="password"
                                       class="form-control {{$errors->has('password') ? 'is-invalid' :'' }}"
                                       value="{{old('password_confirmation')}}" id="password_confirmation"
                                       name="password_confirmation">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-action d-flex justify-content-lg-end justify-content-sm-start">
                    <button class="button button-blue-primary mr-2" type="submit" id="btnUpdateProfile">
                        <span>Actualizar</span>
                    </button>
                    <a href="{{route('admin.profile')}}" class="button button-blue-secondary">
                        Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('optional_scripts')
    <script>
        document.querySelector('#editProfileForm').addEventListener('submit', function (e) {
            e.preventDefault();
            clearErrors();
            let btn = document.querySelector("#btnUpdateProfile");
            disableSubmit(btn, 'Actualizando');
            axios.put(this.action, {
                'name': document.querySelector('#name').value,
                'email': document.querySelector('#email').value,
                'password': document.querySelector('#password').value,
                'password_confirmation': document.querySelector('#password_confirmation').value,
            })
                .then((response) => {
                    enableSubmit(btn, 'Actualizar');
                    clearErrors();
                    console.clear();
                    shootAlert('success', 'Perfil editado.', response.data.msg);
                    document.body.scrollTop = document.documentElement.scrollTop = 0;
                })
                .catch((error) => {
                    enableSubmit(btn, 'Actualizar');
                    clearErrors();
                    document.body.scrollTop = document.documentElement.scrollTop = 0;
                    const errors = error.response.data.errors;
                    Object.keys(errors).forEach(function (k) {
                        const itemDOM = document.getElementById(k);
                        const errorMessage = errors[k];
                        itemDOM.insertAdjacentHTML('afterend',
                            `<div class="invalid-feedback">${errorMessage}</div>`);
                        itemDOM.classList.add('is-invalid');
                        console.clear();
                    });
                })
                .finally(() => {
                    enableSubmit(btn, 'Actualizar');
                })
        });

        function clearErrors() {
            const errorMessages = document.querySelectorAll('.invalid-feedback');
            errorMessages.forEach((element) => element.remove());
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach((element) => element.classList.remove('is-invalid'))
        }
    </script>


@endpush
