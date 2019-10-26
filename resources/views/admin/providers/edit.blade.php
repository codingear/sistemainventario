@extends('admin.layouts._layout')
@section('title', 'Editar Proveedor')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item">
                    <a class="text-main" href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="h5 breadcrumb-item">
                    <a class="text-main" href="{{route('proveedores.index')}}">Proveedores
                    </a>
                </li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">
                    Editar Proveedor
                </li>
            </ol>
        </nav>
    </div>
    <div id="alert_message">

    </div>
    <div class="card shadow mb-4 mt-2 border-bottom-main">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-main">Editar Proveedor</h6>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" id="editProviderForm" class="form-course needs-validation" novalidate method="POST"
                  action={{route('proveedores.update',$provider->id)}} autocomplete="off" role="form">
                @csrf
                @method('PUT')
                @include('admin.providers.partials._form')
            </form>
        </div>
    </div>

    {{--    Modal Delete Course--}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModal">¿Eliminar Registro?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Antes de borrar asegurate que algunos productos no dependan de esta categoría.
                        <br>
                        Está acción es irreversible, borrarás el registro de forma permanente.
                        <input type="hidden" name="category_id" id="cat_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, mantener el registro.
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Si, eliminar registro.
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--Modal--}}
@endsection
@push('optional_scripts')
    <script>
        (function () {
            document.querySelector('#editProviderForm').addEventListener('submit', function (e) {
                e.preventDefault();
                axios.put(this.action, {
                    'name': document.querySelector('#name').value,
                    'contact_name': document.querySelector('#contact_name').value,
                    'rfc': document.querySelector('#rfc').value,
                    'telephone': document.querySelector('#telephone').value,
                    'email': document.querySelector('#email').value,
                    'website': document.querySelector('#website').value,
                    'state_id': document.querySelector('#state_id').value,
                    'city': document.querySelector('#city').value,
                    'zip_code': document.querySelector('#zip_code').value,
                    'address': document.querySelector('#address').value,
                    'notes': document.querySelector('#notes').value,

                })
                    .then(function (response) {
                        const alert = document.querySelector('#alert_message');
                        alert.innerHTML = (`<div class="alert alert-success mt-2" role="alert"><strong> Muy bien.</strong>${response.data.success}</div>`);
                        document.body.scrollTop = document.documentElement.scrollTop = 0;
                        window.setTimeout(function () {
                            window.location.href = '{{ route('proveedores.index') }}'
                        }, 1200);
                        clearErrors();
                        console.clear();
                    })
                    .catch(function (error) {
                        document.body.scrollTop = document.documentElement.scrollTop = 0;
                        const errors = error.response.data.errors;
                        clearErrors();
                        Object.keys(errors).forEach(function (i) {
                            const itemDOM = document.getElementById(i);
                            const errorMessage = errors[i];
                            itemDOM.insertAdjacentHTML('afterend', `<div class="invalid-feedback">${errorMessage}</div>`);
                            itemDOM.classList.add('is-invalid');
                            console.clear();
                        });
                        console.clear();
                    });
            });
        })();

        function clearErrors() {
            // remove all error messages
            const errorMessages = document.querySelectorAll('.invalid-feedback');
            errorMessages.forEach((element) => element.remove());
            // remove all form controls with highlighted error text box
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach((element) => element.classList.remove('is-invalid'))
        }

    </script>
@endpush
