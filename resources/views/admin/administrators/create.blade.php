@extends('admin.layouts._layout')
@section('title', 'Crear Administrador')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-select/bootstrap-select.min.css') }}">
@endpush
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="h5 breadcrumb-item"><a class="text-main"
                                                  href="{{route('administradores.index')}}">Administradores</a></li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Nuevo Administrador</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow mb-4 mt-2 border-bottom-main">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-main">
                Nuevo Administrador
            </h6>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" id="newAdministratorForm" class="form-course needs-validation"
                  novalidate method="POST"
                  action={{route('administradores.store')}} autocomplete="off" role="form">
                @csrf
                @include('admin.administrators.partials._form')
            </form>
        </div>
    </div>
@endsection
@push('optional_scripts')
    <script src="{{ asset('vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script>
        (function () {
            document.querySelector('#newAdministratorForm').addEventListener('submit', function (e) {
                e.preventDefault();
                axios.post(this.action, {
                    'name': document.querySelector('#name').value,
                    'email': document.querySelector('#email').value,
                    'rol': document.querySelector('#rol').value,
                })
                    .then(function (response) {
                        clearErrors();
                        console.clear();
                        shootAlert('success', 'Administrador creadp.', response.data.msg);
                        window.setTimeout(function () {
                            window.location.href = '{{ route('administradores.index') }}'
                        }, 1200);
                    })
                    .catch(function (error) {
                        document.body.scrollTop = document.documentElement.scrollTop = 0;
                        const errors = error.response.data.errors;
                        clearErrors();
                        Object.keys(errors).forEach(function (k) {
                            const itemDOM = document.getElementById(k);
                            const errorMessage = errors[k];

                            if (itemDOM.attributes.name.value != "rol") {
                                itemDOM.insertAdjacentHTML('afterend',
                                    `<div class="invalid-feedback">${errorMessage}</div>`);
                                itemDOM.classList.add('is-invalid');
                            } else {
                                const buttonDropdown = itemDOM.parentElement.childNodes[1];
                                buttonDropdown.insertAdjacentHTML('afterend',
                                    `<div class="invalid-feedback d-block mb-2">${errorMessage}</div>`);
                                buttonDropdown.classList.add('button-is-invalid');
                                buttonDropdown.classList.add('form-control');
                            }
                            console.clear();
                        });
                    });
            });
        })();

            function clearErrors() {
            // remove all error messages
            const errorMessages = document.querySelectorAll('.invalid-feedback');
            errorMessages.forEach((element) => element.remove());
            // remove all form controls with highlighted error text box
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach((element) => element.classList.remove('button-is-invalid'))
            formControls.forEach((element) => element.classList.remove('is-invalid'))
        }
    </script>
@endpush
