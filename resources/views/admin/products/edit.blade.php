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

<form enctype="multipart/form-data" class="needs-validation" method="POST"
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
                        <div class="form-group col-lg-6 col-md-12">
                            <label for="input-name" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :'' }}"
                                value="{{old('name', $product->name )}}" id="input-name" name="name" }}>
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6 col-md-12 {{$errors->has('category_id') ? 'is-invalid' :'' }}">
                            <label for="category_id" class="col-form-label ">Categoría</label>
                            <select id="category_id"
                                class="form-control selectpicker show-tick {{$errors->has('category_id') ? 'is-invalid' :'' }}"
                                name="category_id" data-live-search="true" title="Selecciona una categoría...">
                                {{-- <option selected value=" ">Selecciona una categoría</option> --}}
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id',$product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('rol_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('rol_id') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-3 col-md-12">
                            <label for="input-sale_price" class="col-form-label">Precio de Venta:</label>
                            <input type="text" class="form-control {{$errors->has('sale_price') ? 'is-invalid' :'' }}"
                                value="{{old('sale_price', $product->sale_price)}}" id="input-sale_price"
                                name="sale_price" }>
                            @if ($errors->has('sale_price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('sale_price') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-3 col-md-12">
                            <label for="input-stock" class="col-form-label">Stock:</label>
                            <input type="number" class="form-control {{$errors->has('stock') ? 'is-invalid' :'' }}"
                                value="{{old('stock',$product->stock )}}" id="input-stock" name="stock">
                            @if ($errors->has('stock'))
                            <div class="invalid-feedback">
                                {{ $errors->first('stock') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label for="input-description" class="col-form-label">Descripción</label>
                            <textarea class="form-control {{$errors->has('description') ? 'is-invalid' :'' }}"
                                id="input-description" rows="3"
                                name="description">{{old('description', $product->description )}}</textarea>
                            @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        @if (!Request::is('admin/productos/crear'))
                        <div class="form-group col-lg-4">
                            <div class="custom-control custom-checkbox checkbox-form ">
                                <input type="checkbox" name="status" id="status" class="custom-control-input"
                                    {{($product->status ? 'checked="checked"' : '')}}>
                                <label class="custom-control-label" for="status">Status</label>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-main">
                        Agregar imagenes al Producto
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

    @if (Request::is('admin/productos/crear'))
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4 mt-2 border-bottom-main">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-main">
                        Imagenes del Producto
                    </h6>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    @endif
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

    var myDropzone = new Dropzone('.dropzone', {
            url: '/admin/productos/{{$product->id}}/images',
            acceptedFiles: 'image/jpg, image/jpeg, image/png',
            maxFilesize: .2,
            maxFiles:5,
            paramName: 'productImage',
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            dictDefaultMessage: 'Arrastra las fotos aquí o haz click para subirlas ',
            dictMaxFilesExceeded: 'No puedes subir más de 5 imagenes.'
        });
        Dropzone.autoDiscover = false;
        myDropzone.on('error', function (file, res) {
            var errormsg = res.errors.productImage[0];
            $('.dz-error-message:last > span').text(errormsg);
        });
</script>
@endpush