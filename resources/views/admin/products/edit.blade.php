@extends('admin.layouts._layout')
@section('title', 'Nuevo Producto')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/dropzone/dropzone.css')}}">
@endpush
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('productos.index')}}">Productos</a>
                </li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Editar Producto</li>
            </ol>
        </nav>
    </div>
    <!-- Page Heading -->
    <div id="alert_message">

    </div>

    <form enctype="multipart/form-data" id="editProductForm" class="needs-validation" method="POST"
          action="{{route('productos.update',$product->id)}}" autocomplete="off" role="form">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4 mt-2 border-bottom-main">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-main">
                            Datos Producto
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="name" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control"
                                       value="{{old('name', $product->name )}}" id="name" name="name">
                                {{--                                <div class="invalid-feedback">--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="sku" class="col-form-label">SKU:</label>
                                <input type="text" class="form-control"
                                       value="{{old('sku', $product->sku )}}" id="sku" name="sku">
                            </div>
                            <div
                                class="form-group col-lg-4 col-md-12 {{$errors->has('category_id') ? 'is-invalid' :'' }}">
                                <label for="category_id" class="col-form-label ">Categoría</label>
                                <select id="category_id" data-style="btn-white"
                                        class="form-control selectpicker show-tick {{$errors->has('category_id') ? 'is-invalid' :'' }}"
                                        name="category_id" data-live-search="true" title="Selecciona una categoría...">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id',$product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="sale_price" class="col-form-label">Precio de Venta:</label>
                                <input type="text" class="form-control"
                                       value="{{old('sale_price', $product->sale_price)}}" id="sale_price"
                                       name="sale_price">
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="stock" class="col-form-label">Stock:</label>
                                <input type="number" class="form-control"
                                       value="{{old('stock',$product->stock )}}" id="stock" name="stock">
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="description" class="col-form-label">Descripción</label>
                                <textarea class="form-control" id="description" rows="3"
                                          name="description">{{old('description', $product->description )}}</textarea>
                            </div>
                        </div>
                        {{--                        <div class="form-row">--}}
                        {{--                            @if (!Request::is('admin/productos/crear'))--}}
                        {{--                                <div class="form-group col-lg-4">--}}
                        {{--                                    <div class="custom-control custom-checkbox checkbox-form ">--}}
                        {{--                                        <input type="checkbox" name="status" id="status" class="custom-control-input"--}}
                        {{--                                            {{($product->status ? 'checked="checked"' : '')}}>--}}
                        {{--                                        <label class="custom-control-label" for="status">Status</label>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            @endif--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-main">
                            Imagenes del Producto
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="dropzone"></div>
                            </div>
                        </div>
                        <div class="btn-action">
                            <button class="btn btn-success btn-icon-split btn-sm" type="submit" id="send_form">
                            <span class="icon text-white-50">
                                <i class="fas fa-save fa-sm text-white-50"></i>
                            </span>
                                <span class="text">Guardar</span>
                            </button>
                            <a href="{{route('productos.index')}}" class="btn btn-secondary btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-long-arrow-alt-left fa-sm text-white-50"></i>
                            </span>
                                <span class="text">Cancelar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@push('optional_scripts')
    <script src="{{ asset('vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('vendors/dropzone/dropzone.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#category_id').selectpicker({
                "noneResultsText": 'No hay resultados coincidentes'
            });
        });

        (function () {
            document.querySelector('#editProductForm').addEventListener('submit', function (e) {
                e.preventDefault();
                axios.put(this.action, {
                    'name': document.querySelector('#name').value,
                    'sku': document.querySelector('#sku').value,
                    'category_id': document.querySelector('#category_id').value,
                    'sale_price': document.querySelector('#sale_price').value,
                    'stock': document.querySelector('#stock').value,
                    'description': document.querySelector('#description').value,
                })
                    .then(function (response) {
                        const alert = document.querySelector('#alert_message');
                        alert.innerHTML = (`<div class="alert alert-success mt-2" role="alert"><strong> Muy bien.</strong> ${response.data.success}</div>`);
                        document.body.scrollTop = document.documentElement.scrollTop = 0;
                        window.setTimeout(function () {
                            window.location.href = '{{ route('productos.index') }}'
                        }, 1200);
                        clearErrors();
                        console.clear();
                    })
                    .catch(function (error) {
                        // console.log(error);
                        const errors = error.response.data.errors;
                        clearErrors();
                        Object.keys(errors).forEach(function (k) {
                            const itemDOM = document.getElementById(k);
                            const errorMessage = errors[k];
                            document.querySelector('#editProductForm').scrollIntoView();
                            itemDOM.insertAdjacentHTML('afterend', `<div class="invalid-feedback">${errorMessage}</div>`);
                            itemDOM.classList.add('is-invalid');
                            // console.clear();
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


        let myDropzone = new Dropzone('.dropzone', {
            url: '/admin/productos/{{$product->id}}/images',
            acceptedFiles: 'image/jpg, image/jpeg, image/png',
            maxFilesize: 2,
            maxFiles: 5,
            paramName: 'productImage',
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            dictDefaultMessage: 'Arrastra las fotos aquí o haz click para subirlas ',
            dictMaxFilesExceeded: 'No puedes subir más de 5 imagenes.'
        });
        Dropzone.autoDiscover = false;
        myDropzone.on('error', function (file, res) {
            let errormsg = res.errors.productImage[0];
            $('.dz-error-message:last > span').text(errormsg);
        });
    </script>

@endpush
