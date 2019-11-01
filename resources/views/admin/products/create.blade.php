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
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Crear Producto</li>
            </ol>
        </nav>
    </div>
    <!-- Page Heading -->
    <div id="alert_message">
    </div>
    <form enctype="" id="editProductForm" class="needs-validation" method="POST" action="{{route('productos.store')}}"
          autocomplete="off" role="form">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col d-flex align-items-stretch data-product">
                <div class="card shadow mb-4 mt-2 border-bottom-main w-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-main">
                            Datos Producto
                        </h6>
                    </div>
                    <div class="card-body mb-2">
                        <div class="form-row">
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="name" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" value="" id="name" name="name">
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="sku" class="col-form-label">SKU:</label>
                                <input type="text" class="form-control" value="" id="sku" name="sku">
                            </div>
                            <div
                                class="form-group col-lg-4 col-md-12 {{$errors->has('category_id') ? 'is-invalid' :'' }}">
                                <label for="category_id" class="col-form-label ">
                                    @if($categories->count()<=0) Sin Categorías. @else Categorías @endif </label>
                                @if($categories->count()<=0) <a href="{{route('categorias.create')}}"
                                                                style="font-size: .8rem;">
                                    Agregar
                                    Categorías</a>
                                @endif
                                <select id="category_id" data-style="btn-white"
                                        {{($categories->count()<=0) ? 'disabled' : ''}}
                                        class="form-control selectpicker show-tick {{$errors->has('category_id') ? 'is-invalid' :'' }}"
                                        name="category_id" data-live-search="true"
                                        title="Selecciona una categoría...">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="sale_price" class="col-form-label">Precio de Venta:</label>
                                <input type="text" class="form-control" value="" id="sale_price" name="sale_price">
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="stock" class="col-form-label">Stock:</label>
                                <input type="number" class="form-control" value="" id="stock" name="stock">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="description" class="col-form-label">Descripción</label>
                                <textarea class="form-control" id="description" rows="4" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-action">
                            <button class="button button-blue-primary" type="submit" id="send_form">
                                Guardar
                            </button>
                            <a href="{{route('productos.index')}}" class="button button-blue-secondary">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col d-flex align-items-stretch img-principal">
                <div class="card shadow mb-4 mt-2 border-bottom-main w-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-main">
                            Imagen principal
                        </h6>
                    </div>
                    <div class="card-body mb-2">
                        <img src="https://dummyimage.com/900x900/f8f9fc/919191.png&text=Sin+Imagen"
                             class="img__principal"
                             alt="" id="principal_image">
                        <!-- <p class="text-center align-middle"> -->
                        <input type="text" class="invisible" name="principal_image" id="principal_image_field" hidden>
                        <!-- </p> -->
                    </div>
                    <div class="card-footer text-muted text-center">
                        <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal"
                                data-target=".bd-example-modal-xl" data-action="to_principal">
                        <span class="icon text-white-50">
                            <i class="fas fa-upload fa-sm text-white-50"></i>
                        </span>
                            <span class="text text-light">Agregar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4 mt-2 border-bottom-main text-center">
                    <div class="card-header py-3 d-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-main">
                            Galería de imágenes
                            <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Ayuda"
                               data-content="Puedes agregar imágenes sin limite por producto, 2MB por imagen.">
                                <i class="fas fa-question-circle info-img"></i>
                            </a>
                        </h6>
                    </div>
                    <div class="card-body mb-2">
                        <p class="text-center align-middle">
                            <div id="msg-gallery">
                        <p class="card-text">Aún no se cuenta con imagenes</p>
                    </div>
                    <div id="gallery_select" class="container__imgs grid">

                    </div>
                    </p>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal"
                            data-target=".bd-example-modal-xl" data-action="to_gallery">
                        <span class="icon text-white-50">
                            <i class="fas fa-upload fa-sm text-white-50"></i>
                        </span>
                        <span class="text text-light">Agregar</span>
                    </button>
                </div>
            </div>
        </div>
        </div>
    </form>
    <!-- VENTANA MODAL -->
    <div id="myModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header d-flex flex-column">
                    <h5 class="modal-title" id="exampleModalLabel">Galería de imágenes</h5>
                    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="uploadImage" data-toggle="tab" href="#upload" role="tab"
                               aria-controls="home" aria-selected="true">Cargar Imágen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Galería de Imágenes</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="home-tab">
                            <!-- LISTA DE IMAGENES -->
                            <div id="gallery" class="grid grid-modal" data-selector="">
                                @foreach($images as $image)
                                    <div class="item" data-id="{{$image->id}}" id="item-img">
                                        <img class="thumbnail" data-src="{{$image->url}}" src="{{$image->url}}"
                                             alt="{{$image->text_alter}}">
                                    </div>
                                @endforeach
                            </div>
                            <!-- LISTA DE IMAGENES -->
                        </div>
                        <div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="dropzone"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal"
                            data-target=".bd-example-modal-xl" data-dismiss="modal">
                    <span class="icon text-white-50">
                        <i class="fas fa-times fa-sm text-white-50"></i>
                    </span>
                        <span class="text text-light">Cerrar</span>
                    </button>
                    <button type="button" id="select_imgs" class="btn btn-info btn-icon-split btn-sm"
                            data-toggle="modal"
                            data-target=".bd-example-modal-xl" data-dismiss="modal">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus fa-sm text-white-50"></i>
                    </span>
                        <span class="text text-light">Agregar Seleccionadas</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- VENTANA MODAL -->
@endsection
@push('optional_scripts')
    <script src="{{ asset('vendors/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('vendors/multiselector/multiselector.min.js') }}"></script>
    <script src="{{ asset('vendors/jqueryLazy/jquery.lazy.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.lazy').Lazy({
                scrollDirection: 'vertical',
                effect: 'fadeIn',
            });
        });


        // SELECCIONAR IMAGENES DE GALERIA

        $('#gallery').multiSelector({
            selector: '#item-img',
            disableShift: false,
            disableCtrl: false,
        });


        $('#myModal').on('shown.bs.modal', function (e) {
            $("#select_imgs").removeAttr("data-section");
            var $action = e.relatedTarget.dataset.action;
            if ($action == 'to_principal') {
                $("#gallery").attr("data-selector", "to_principal");
                $("#select_imgs").attr("data-section", "principal");
                // LIMPIANDO EL PROTOTIPO
                $('#gallery').unbind();
                // LIMPIANDO EL PROTOTIPO
                $('#gallery').multiSelector({
                    selector: '#item-img',
                    disableShift: true,
                    disableCtrl: true,
                });

            } else if ($action == 'to_gallery') {
                $("#gallery").attr("data-selector", "to_gallery");
                $("#select_imgs").attr("data-section", "gallery");
                // LIMPIANDO EL PROTOTIPO
                $('#gallery').unbind();
                // LIMPIANDO EL PROTOTIPO
                $('#gallery[data-selector="to_gallery"]').multiSelector({
                    selector: '#item-img',
                    disableShift: false,
                    disableCtrl: false,
                });
            }
        });
        $('#myModal').on('hidden.bs.modal', function (e) {
            $("#gallery").multiSelector('deselect');
        })

        var $list_images = [];

        $("#select_imgs").click(function (e) {
            var $section = e.currentTarget.dataset.section;

            console.log($section);

            var $items = $("#gallery").multiSelector('get');
            $.each($items, function (k, v) {
                var $id = v.dataset['id'];
                var $src = v.children[0].attributes.src.nodeValue;
                if ($section == 'principal') {
                    $("#principal_image").attr("src", $src);
                    $("#principal_image_field").val($id);
                } else if ($section == 'gallery') {
                    checkImage($id, $src);
                }
            })
            printImages();
        });

        $("#gallery_select").on('click', '#deleteImg', function (i) {
            i.stopPropagation();
            var $btn = $(i.target).is('button') ? $(i.target) : $(i.target).parent();
            $id = $btn[0].dataset.id;
            for (let index = 0; index < $list_images.length; index++) {
                if ($list_images[index].key == $id) {
                    $list_images.splice(index, 1);
                    break;
                }
            }
            printImages();
        });

        function checkImage($key, $src) {
            if ($list_images.length > 0) {
                var repetido = false;
                $.each($list_images, function (k, v) {
                    if (v.key == $key) {
                        repetido = true;
                    }
                })
                if (repetido == false) {
                    $list_images.push({
                        "key": $key,
                        "src": $src
                    });
                }
            } else {
                $list_images.push({
                    "key": $key,
                    "src": $src
                });
            }
        };

        function printImages() {
            if ($list_images.length == 0) {
                $("#msg-gallery").html('<p class="card-text">Aún no se cuentan con imagenes</p>');
                $("#gallery_select").html("");
            } else {
                $("#msg-gallery").html('');
                $("#gallery_select").html("");
                $.each($list_images, function (ke, va) {
                    // <div class="item" data-id="001"></div>
                    $("#gallery_select").append("<div class='item container_item'><img src=" + va.src +
                        " class=thumbnail><input type=text id='gallery_images' name='gallery_photos[]' value=" + va.key +
                        " hidden><button id=deleteImg class=btnDeleteImg data-id=" + va.key +
                        "><i class='fas fa-times' aria-hidden='true'></i></button></div>");
                })
            }
        }


        // SELECCIONAR IMAGENES DE GALERIA

        // CONFIGURACIÓN DE DROPZONE
        let myDropzone = new Dropzone('.dropzone', {
            url: '/admin/imagenes',
            acceptedFiles: 'image/jpg, image/jpeg, image/png',
            maxFilesize: .2,
            paramName: 'image',
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            dictDefaultMessage: 'Arrastra las fotos aquí o haz click para subirlas (max 2mb)',
            dictMaxFilesExceeded: 'No puedes subir más de 5 imagenes.',
            dictRemoveFile: 'Remover Imagen',
            dictFallbackMessage: 'Tu navegador no soporta la carga de archivos por favor actualiza.',
            dictFallbackText: 'Please use the fallback form below to upload your files like in the olden days.',
            dictFileTooBig: 'Tu archivo es muy grande.',
            dictInvalidFileType: 'No se permite cargar archivos de este tipo.',
            dictCancelUpload: 'Cancelar la carga',
            dictCancelUploadConfirmation: '¿Estas seguro que quieres cancelar esta carga?',

            init: function () {
                this.on("success", function (file, response) {
                    if ($(".item").toArray().length <= 0) {
                        $(".container-alert").addClass('d-none');
                        $('.grid-modal').append(`<div class="item" data-id="${response.id}" id="item-img">
                                        <img class="thumbnail"
                                             data-src="${response.url}"
                                             src="${response.url}"
                                             alt="${response.alt_text}">
                                       </div>`)
                    } else if ($(".item").toArray().length >= 1) {
                        $('.grid-modal').children('.item').first()
                            .before(`<div class="item" data-id="${response.id}" id="item-img">
                                        <img class="thumbnail"
                                             data-src="${response.url}"
                                             src="${response.url}"
                                             alt="${response.alt_text}">
                                       </div>`);
                    }
                    ;
                });


            },
        });
        Dropzone.autoDiscover = false;


        // CONFIGURACIÓN DE DROPZONE
        $(document).ready(function () {
            $('#category_id').selectpicker({
                "noneResultsText": 'No hay resultados coincidentes'
            });
            $(function () {
                $('[data-toggle="popover"]').popover()
            })
        });


        document.querySelector('#editProductForm').addEventListener('submit', function (e) {
            e.preventDefault();
            console.log("submiteando")
            axios.post(this.action, {
                'name': document.querySelector('#name').value,
                'sku': document.querySelector('#sku').value,
                'category_id': document.querySelector('#category_id').value,
                'sale_price': document.querySelector('#sale_price').value,
                'stock': document.querySelector('#stock').value,
                'description': document.querySelector('#description').value,
                'principal_image': document.querySelector('#principal_image_field').value,
                'gallery': $list_images,
            })
                .then(function (response) {
                    const alert = document.querySelector('#alert_message');
                    alert.innerHTML = (`<div class="alert alert-success mt-2 alert-notifier" role="alert">Producto Guardado.</div>`);
                    window.setTimeout(function () {
                        $(".alert-notifier").fadeTo(600, 0).slideUp(600, function () {
                            $(this).remove();
                        });
                    }, 1800);
                    clearErrors();
                    console.clear();
                    window.setTimeout(function () {
                        window.location.href = '{{route('productos.index')}}';
                    }, 1000);

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

        function clearErrors() {
            const errorMessages = document.querySelectorAll('.invalid-feedback');
            errorMessages.forEach((element) => element.remove());
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach((element) => element.classList.remove('is-invalid'))
        }

        $('#uploadImage').on('hide.bs.tab', function (e) {
            myDropzone.removeAllFiles();
        });

    </script>
























@endpush
