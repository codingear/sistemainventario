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
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Crear Producto</li>
            </ol>
        </nav>
    </div>
    <!-- Page Heading -->
    <div id="alert_message">
    </div>
    <form enctype="" id="editProductForm" class="needs-validation" method="POST" action="{{route('productos.store')}}" autocomplete="off" role="form">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-12 col-lg-9 d-flex align-items-stretch">
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
                                <input type="text" class="form-control" value=""
                                       id="name"
                                       name="name">
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="sku" class="col-form-label">SKU:</label>
                                <input type="text" class="form-control" value="" id="sku"
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
                                <input type="text" class="form-control"
                                       value=""
                                       id="sale_price" name="sale_price">
                            </div>
                            <div class="form-group col-lg-4 col-md-12">
                                <label for="stock" class="col-form-label">Stock:</label>
                                <input type="number" class="form-control" value=""
                                       id="stock" name="stock">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="description" class="col-form-label">Descripción</label>
                                <textarea class="form-control" id="description" rows="4"
                                          name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
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
            <div class="col-md-12 col-lg-3 d-flex align-items-stretch">
                <div class="card shadow mb-4 mt-2 border-bottom-main w-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-main">
                            Imagen principal
                        </h6>
                    </div>
                    <div class="card-body mb-2">
                        <p class="text-center align-middle">
                            <img src="https://dummyimage.com/900x900/f8f9fc/919191.png&text=Sin+Imagen" class="img__principal" alt="" id="principal_image">
                            <input type="text" class="visible" name="principal_image" id="principal_image_field" >
                        </p>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target=".bd-example-modal-xl" data-action="to_principal">
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
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4 mt-2 border-bottom-main text-center">
                <div class="card-header py-3 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold text-main">
                        Galería de imágenes
                        <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Ayuda"
                           data-content="Puedes agregar 5 imagenes por producto, 2MB por imagen.">
                            <i class="fas fa-question-circle info-img"></i>
                        </a>
                    </h6>
                </div>
                <div class="card-body mb-2">
                    <p class="text-center align-middle">
                        <div id="gallery_select" class="container__imgs">
                            <p class="card-text">Aún no se cuentan con imagenes</p>
                        </div>
                    </p>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target=".bd-example-modal-xl" data-action="to_gallery">
                        <span class="icon text-white-50">
                            <i class="fas fa-upload fa-sm text-white-50"></i>
                        </span>
                        <span class="text text-light">Agregar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- VENTANA MODAL -->
    <div id="myModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Galería de imágenes</h5>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="home" aria-selected="true">Cargar Imágen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Galería de Imágenes</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="home-tab">
                            <!-- LISTA DE IMAGENES -->








                            <ul id="gallery" class="container__imgs" data-selector="">
                                <div class="images-container mt-2">
                                    <div class="grid">
                                        @foreach($images as $image)
                                            <div class="item">
                                                <img class="lazy thumbnail"
                                                     src="{{$image->url}}"
                                                     data-src="{{$image->url}}"
                                                     data-id="{{$image->id}}"
                                                     data-toggle="modal"
                                                     data-target="#modalInfoImage" alt="imagen"/>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>




                                <li class="" data-id="001">
                                    <img src="https://dummyimage.com/100x100/F5B551/fff.png" alt="">
                                </li>
                                <li class="" data-id="002">
                                    <img src="https://dummyimage.com/100x100/6CD7FD/fff.png" alt="">
                                </li>
                                <li class="" data-id="003">
                                    <img src="https://dummyimage.com/100x100/9FA2FB/fff.png" alt="">
                                </li>
                                <li class="" data-id="004">
                                    <img src="https://dummyimage.com/100x100/DAC514/fff.png" alt="">
                                </li>
                                <li class="" data-id="005">
                                    <img src="https://dummyimage.com/100x100/de2fde/fff.png" alt="">
                                </li>
                            </ul>
                            <style>
                                .ms-selected{
                                    display: inline-block;
                                    border: 2px solid blue;
                                }
                                .img__principal{
                                    width: 100%;
                                    margin-bottom: 1.5em;
                                }
                            </style>
                            <!-- LISTA DE IMAGENES -->
                        </div>
                        <div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledby="profile-tab">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit non quaerat cumque, veniam odit sint.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target=".bd-example-modal-xl" data-dismiss="modal">
                        <span class="icon text-white-50">
                            <i class="fas fa-times fa-sm text-white-50"></i>
                        </span>
                        <span class="text text-light">Cerrar</span>
                    </button>
                    <button type="button" id="select_imgs" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target=".bd-example-modal-xl" data-dismiss="modal">
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
    <script src="{{ asset('vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('vendors/multiselector/multiselector.min.js') }}"></script>
    <script>
        // SELECCIONAR IMAGENES DE GALERIA

        $('#gallery').multiSelector({
            selector:'li',
            disableShift: false,
            disableCtrl: false,
        });


        $('#myModal').on('shown.bs.modal', function (e) {
            $("#select_imgs").removeAttr("data-section");
            var $action = e.relatedTarget.dataset.action;
            if($action == 'to_principal'){
                $("#gallery").attr("data-selector","to_principal");
                $("#select_imgs").attr("data-section","principal");
                // LIMPIANDO EL PROTOTIPO
                $('#gallery').unbind();
                // LIMPIANDO EL PROTOTIPO
                $('#gallery').multiSelector({
                    selector:'li',
                    disableShift: true,
                    disableCtrl: true,
                });

            }else if($action == 'to_gallery'){
                $("#gallery").attr("data-selector","to_gallery");
                $("#select_imgs").attr("data-section","gallery");
                // LIMPIANDO EL PROTOTIPO
                $('#gallery').unbind();
                // LIMPIANDO EL PROTOTIPO
                $('#gallery[data-selector="to_gallery"]').multiSelector({
                    selector:'li',
                    disableShift: false,
                    disableCtrl: false,
                });
            }
        });
        $('#myModal').on('hidden.bs.modal', function (e) {
            $("#gallery").multiSelector('deselect');
        })

        var $list_images = [];

        $("#select_imgs").click(function(e){
            var $section = e.currentTarget.dataset.section;

            console.log($section);

            var $items = $("#gallery").multiSelector('get');
            $.each($items, function(k,v){
                var $id = v.dataset['id'];
                var $src = v.children[0].attributes.src.nodeValue;
                if($section == 'principal'){
                    $("#principal_image").attr("src",$src);
                    $("#principal_image_field").val($id);
                }else if($section == 'gallery'){
                    checkImage($id,$src);
                }
            })
            printImages();
        });

        $("#gallery_select").on('click','button#deleteImg',function(i){
            $id = i.target.dataset.id;
            for (let index = 0; index < $list_images.length; index++) {
                if($list_images[index].key == $id){
                    $list_images.splice(index,1);
                    break;
                }
            }
            printImages();
        });

        function checkImage($key,$src){
            if($list_images.length > 0){
                var repetido = false;
                $.each($list_images,function(k,v){
                    if(v.key == $key){
                        repetido = true;
                    }
                })
                if(repetido == false){
                    $list_images.push({
                        "key" : $key,
                        "src" : $src
                    });
                }
            }else{
                $list_images.push({
                    "key" : $key,
                    "src" : $src
                });
            }
        };

        function printImages(){
            if($list_images.length == 0){
                $("#gallery_select").html('<p class="card-text">Aún no se cuentan con imagenes</p>');
            }else{
                $("#gallery_select").html("");
                $.each($list_images,function(ke,va){
                    $("#gallery_select").append("<img src=" + va.src +"><input type=text value="+va.key+"><button id=deleteImg data-id="+va.key+">delete</button>");
                })
            }
        }




        // SELECCIONAR IMAGENES DE GALERIA

        $(document).ready(function () {
            $('#category_id').selectpicker({
                "noneResultsText": 'No hay resultados coincidentes'
            });
            $(function () {
                $('[data-toggle="popover"]').popover()
            })
        });

        (function () {
            document.querySelector('#editProductForm').addEventListener('submit', function (e) {
                e.preventDefault();
                console.log("submiteando")
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
@endpush
