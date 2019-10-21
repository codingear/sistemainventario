@extends('admin.layouts._layout')
@section('title', 'Nuevo Producto')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-select/bootstrap-select.min.css') }}">
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
                    <div class="card-body mb-2">
                        <div class="form-row">
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="name" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" value="{{old('name', $product->name )}}"
                                       id="name"
                                       name="name">
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="sku" class="col-form-label">SKU:</label>
                                <input type="text" class="form-control" value="{{old('sku', $product->sku )}}" id="sku"
                                       name="sku">
                            </div>
                            <div
                                class="form-group col-lg-4 col-md-12 {{$errors->has('category_id') ? 'is-invalid' :'' }}">
                                <label for="category_id" class="col-form-label ">
                                    @if($categories->count()<=0)
                                        Sin Categorías.
                                    @else
                                        categorias
                                    @endif
                                </label>
                                @if($categories->count()<=0)
                                    <a href="{{route('categorias.create')}}" style="font-size: .8rem;">
                                        Agregar
                                        Categorías</a>
                                @endif
                                <select id="category_id" data-style="btn-white"
                                        {{($categories->count()<=0) ? 'disabled' : ''}}
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
                                       value="{{old('sale_price', $product->sale_price)}}"
                                       id="sale_price" name="sale_price">
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="stock" class="col-form-label">Stock:</label>
                                <input type="number" class="form-control" value="{{old('stock',$product->stock )}}"
                                       id="stock" name="stock">
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="description" class="col-form-label">Descripción</label>
                                <textarea class="form-control" id="description" rows="3"
                                          name="description">{{old('description', $product->description )}}</textarea>
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
                                <span class="text">Volver atrás</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4 mt-2 border-bottom-main">
                <div class="card-header py-3 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold text-main">
                        Imagenes del Producto
                        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Ayuda"
                           data-content="Puedes agregar 5 imagenes por producto, 2MB por imagen.">
                            <i class="fas fa-question-circle info-img"></i>
                        </a>
                    </h6>
                </div>
                <div class="card-body mb-2">
                    <form action="" role="form" onsubmit="return false;" method="post" enctype="multipart/form-data"
                          id="formProductImage">
                        <div class="row justify-content-center">
                            @if($product->images->count()<=0)
                                <div class="container-preview imgUp">
                                    <span class="title-imgPreview">Imagen principal </span>
                                    <div class="imgPreview"
                                         style="background: url(https://dummyimage.com/300x300/EBEBEB/807d80.png&text=Imagen+del+Producto); "></div>
                                    <label class="btn btn-primary label-up">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <span class="text-btnUp">Subir Imagen</span>
                                        <input type="file" class="uploadFile img" value="Subir Imagen"
                                               id="imageProduct-1"
                                               name="imageProduct"
                                               style="width: 0px;height: 0px;overflow: hidden;">
                                    </label>
                                </div>
                            @else
                                @foreach($product->images as $key => $image)
                                    <div class="container-preview imgUp"
                                         data-imageId="{{($image->id>0) ? $image->id: 0}}">
                                        <span class="title-imgPreview">Imagen de galería </span>
                                        <div class="imgPreview" style="background: url({{$image->url}}); "></div>
                                        <label class="btn btn-primary label-up">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <span class="text-btnUp">Subir Imagen</span>
                                            <input type="file" class="uploadFile img" value="Subir Imagen"
                                                   name="imageProduct"
                                                   id="imageProduct-{{$key+1}}"
                                                   style="width: 0px;height: 0px;overflow: hidden;">
                                        </label>
                                        @if($key>0)
                                            <button class="btn btn-sm btn-danger del btn-DeleteImage"
                                                    data-id="{{$image->id}}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        @endif
                                        {{--                            aqui va cualquier mensaje de error--}}
                                    </div>
                                @endforeach
                            @endif
                            <i class="fa fa-plus imgAdd"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('optional_scripts')
    <script src="{{ asset('vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#category_id').selectpicker({
                "noneResultsText": 'No hay resultados coincidentes'
            });
            $(function () {
                $('[data-toggle="popover"]').popover()
            })

            if ($(".imgPreview").toArray().length > 4) {
                document.querySelector('.imgAdd').style.setProperty('display', 'none', 'important');
            } else if ($(".imgPreview").toArray().length < 5) {
                document.querySelector('.imgAdd').style.setProperty('display', 'flex', 'important');
            }
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
                        document.body.scrollTop = document.documentElement.scrollTop = 0;
                        const errors = error.response.data.errors;
                        clearErrors();
                        Object.keys(errors).forEach(function (k) {
                            const itemDOM = document.getElementById(k);
                            const errorMessage = errors[k];
                            itemDOM.insertAdjacentHTML('afterend', `<div class="invalid-feedback">${errorMessage}</div>`);
                            itemDOM.classList.add('is-invalid');
                            console.clear();
                        });
                    });
            });
        })();

        function clearErrors() {
            const errorMessages = document.querySelectorAll('.invalid-feedback');
            errorMessages.forEach((element) => element.remove());
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach((element) => element.classList.remove('is-invalid'))
        }

    </script>
    <script>
        $('.imgAdd').click(function () {
            $(this)
                .closest('.row')
                .find('.imgAdd')
                .before(
                    `<div class="container-preview imgUp" data-imageId="0">
          <span class="title-imgPreview">Imagen de galería </span>
                         <div class="imgPreview" style="background: url(https://dummyimage.com/300x300/EBEBEB/807d80.png&text=Imagen+del+Producto); "></div>
                          <label class="btn btn-primary label-up">
                            <i class="fas fa-cloud-upload-alt"></i>
                                <span class="text-btnUp">Subir Imagen</span>
                            <input type="file" class="uploadFile img" value="Subir Imagen" name="imageProduct" id="imageProduct-${($(".imgPreview").toArray().length) + 1}"
                                style="width: 0px;height: 0px;overflow: hidden;">
                          </label>
                          <button class="btn btn-sm btn-danger del">
                            <i class="fa fa-times"></i>
                           </button>
                    </div>
                    `
                );
            if ($(".imgPreview").toArray().length > 4) {
                document.querySelector('.imgAdd').style.setProperty('display', 'none', 'important');
            }
        });

        $(document).on('click', 'button.del', function (e) {
            e.preventDefault();
            let id = $(this).attr('data-id')
            axios({
                method: 'delete',
                url: '/admin/productos/images/delete',
                data: {
                    'id': id
                }
            })
                .then(function (response) {
                    console.log(response.data.success);
                    //window.location.reload(true);
                })
                .catch(function (error) {
                    console.log(error);
                });


            $(this)
                .parent()
                .remove();

            if ($(".imgPreview").toArray().length < 5) {
                document.querySelector('.imgAdd').style.setProperty('display', 'flex', 'important');
            }
        });


        $(function () {
            $(document).on('change', '.uploadFile', function (e) {
                let uploadFile = $(this);
                let files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) {
                    let sizeImg = files[0].size / 1024;//Se convierte a kilobyte
                    // only image file
                    let reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    if (sizeImg <= 2048) {
                        let is_principal = (e.target.id == 'imageProduct-1') ? true : false;
                        let idImage = e.target.parentElement.parentElement.dataset.imageid
                        let data = new FormData();
                        data.append('imageProduct', e.target.files[0]);
                        data.append('is_principal', is_principal);


                        if (idImage > 0) {
                            data.append('id', idImage);
                            data.append('_method', 'PATCH');
                            axios({
                                method: 'post',
                                url: '/admin/productos/images/update',
                                data: data
                            })
                                .then(function (response) {
                                    window.location.reload(true);
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });


                        } else {
                            axios({
                                method: 'post',
                                url: '/admin/productos/{{$product->id}}/images',
                                data: data
                            })
                                .then(function (response) {
                                    console.log(response.data.success);
                                    window.location.reload(true);
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        }

                        reader.onloadend = function () {
                            uploadFile
                                .closest('.imgUp')
                                .find('.imgPreview')
                                .css('background-image', 'url(' + this.result + ')')

                            deleteMessage('error')
                            deleteMessage('success')
                            showMessage(uploadFile, 'success', "Imagen actualizada.")
                        };
                    } else {
                        deleteMessage('error')
                        showMessage(uploadFile, 'error', "Tamaño superior a 2 MB.")
                    }
                } else {
                    deleteMessage('error')
                    showMessage(uploadFile, 'error', "Tipo de archivo invalido.")
                }

                function showMessage(element, type, msj) {
                    element
                        .closest('.imgUp')
                        .find('.label-up')
                        .after(
                            `<p class="img-${type}">${msj}</p>`
                        );
                }

                function deleteMessage(type) {
                    uploadFile.closest('.imgUp')
                        .find(`.img-${type}`)
                        .remove()
                }
            });
        });
    </script>
@endpush
