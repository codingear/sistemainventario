@extends('admin.layouts._layout')
@section('title', 'Crear Categoría')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('categorias.index')}}">Categorías</a>
                </li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Nueva Categoría</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow mb-4 mt-2 border-bottom-main">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-main">
                Nueva Categoría
            </h6>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" id="newCategoryForm" class="form-course needs-validation" novalidate
                  method="POST"
                  action={{route('categorias.store')}} autocomplete="off" role="form">
                @csrf
                @include('admin.categories.partials._form')
            </form>
        </div>
    </div>
@endsection
@push('optional_scripts')
    <script>
        (function () {
            document.querySelector('#newCategoryForm').addEventListener('submit', function (e) {
                e.preventDefault();
                clearErrors();
                let btn = document.querySelector("#submit-btn");
                disableSubmit(btn, 'Guardando');
                axios.post(this.action, {
                    'name': document.querySelector('#name').value,
                    'description': document.querySelector('#description').value,
                })
                    .then((response) => {
                        enableSubmit(btn, 'Guardar');
                        clearErrors();
                        console.clear();
                        shootAlert('success', 'Categoría creada.', response.data.msg);
                        window.setTimeout(function () {
                            window.location.href = '{{ route('categorias.index') }}'
                        }, 1200);
                    }).catch((error) => {
                    enableSubmit(btn, 'Guardar');
                    document.body.scrollTop = document.documentElement.scrollTop = 0;
                    clearErrors();
                    const errors = error.response.data.errors;
                    Object.keys(errors).forEach(function (k) {
                        const itemDOM = document.getElementById(k);
                        const errorMessage = errors[k];
                        itemDOM.insertAdjacentHTML('afterend',
                            `<div class="invalid-feedback">${errorMessage}</div>`);
                        itemDOM.classList.add('is-invalid');
                        console.clear();
                    });
                }).finally(() => {
                    enableSubmit(btn, 'Guardar');
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
