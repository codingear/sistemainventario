@extends('admin.layouts._layout')
@section('title', 'Editar Categoría')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('categorias.index')}}">Categorías</a>
                </li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Editar Categoría</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow mb-4 mt-2 border-bottom-main">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-main">Editar categoría</h6>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" id="editCategoryForm" class="form-course needs-validation" novalidate
                  method="POST"
                  action={{route('categorias.update',$category->id)}} autocomplete="off" role="form">
                @csrf
                @method('PUT')
                @include('admin.categories.partials._form')
            </form>
        </div>
    </div>
@endsection
@push('optional_scripts')
    <script>
        (function () {
            document.querySelector('#editCategoryForm').addEventListener('submit', function (e) {
                e.preventDefault();
                axios.put(this.action, {
                    'name': document.querySelector('#name').value,
                    'description': document.querySelector('#description').value,
                    'status': document.querySelector('#status').checked,
                })
                    .then(function (response) {
                        clearErrors();
                        console.clear();
                        shootAlert('success', 'Categoría editada.', response.data.msg);
                        window.setTimeout(function () {
                            window.location.href = '{{ route('categorias.index') }}'
                        }, 1200);
                    })
                    .catch(function (error) {
                        document.body.scrollTop = document.documentElement.scrollTop = 0;
                        const errors = error.response.data.errors;
                        clearErrors();
                        Object.keys(errors).forEach(function (k) {
                            const itemDOM = document.getElementById(k);
                            const errorMessage = errors[k];
                            itemDOM.insertAdjacentHTML('afterend',
                                `<div class="invalid-feedback">${errorMessage}</div>`);
                            itemDOM.classList.add('is-invalid');
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
            formControls.forEach((element) => element.classList.remove('is-invalid'))
        }

    </script>
@endpush
