@extends('admin.layouts._layout')
@section('title', 'Imágenes')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/dropzone/dropzone.css')}}">
@endpush
@section('content')
    @if($images->count()<=0)
        <div class="d-flex justify-content-center container-noinfo">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="container-noinfo_icon justify-content-center">
                    <i class="fas fa-images"></i>
                </div>
                <div class="container-noinfo_text justify-content-center">
                    <p>
                        Gestiona tu galería de imagenes.
                    </p>
                    <button type="button" class="button button-blue-primary" name="btnOpenAddImages" id="btnOpenAddImages">
                        Añadir Imágenes
                    </button>
                </div>
            </div>
        </div>
    @else
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-start justify-content-between">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="h5 breadcrumb-item "><a class="text-main" href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Galería de Imágenes</li>
                </ol>
            </nav>

            <button type="button" class="button button-blue-primary" name="btnOpenAddImages" id="btnOpenAddImages">
                Añadir Imágenes
            </button>

        </div>
        {{-- Page Heading--}}
    @endif



    <div class="row d-none" id="container-DropZone">
        <div class="col-12">
            <div class="card mb-4 mt-2 border-bottom-main">
                <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-main d-inline">
                        Agregar imágenes
                    </h6>
                    <button type="button" name="btnCloseAddImages" id="btnCloseAddImages"
                            class="btn btn-danger btn-sm float-right">
                        <i class="fas fa-times fa-sm"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="dropzone"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Page Content -->
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
    <!-- /.container -->

    <!-- Modal -->
    <div class="modal fade" id="modalInfoImage" tabindex="-1" role="dialog" aria-labelledby="examplemodalInfoImage"
         aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-main" id="examplemodalInfoImage">Detalles Imagen </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div id="alert_message">
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div
                                class="col-lg-6 col-12 d-flex flex-lg-column flex-row-reverse justify-content-end col-modal">
                                <div class="modal-thumbnail">
                                    <img src="" alt="..." class="thumbnail-image ">
                                </div>
                            </div>
                            <div
                                class="col-lg-6 col-12 d-flex justify-content-lg-start col-modal mt-4">
                                <div class="col-data">
                                    <form class="form-row" id="FormImage" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" hidden id="image_id">
                                        <div class="form-group col-12">
                                            <label for="title">Título</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="text_alt">Texto alternativo</label>
                                            <input type="text" class="form-control" id="text_alt" name="text_alt">
                                        </div>
                                        <div class="btn-action d-flex align-items-end">
                                            <button type="submit" name="btnFormImage" id="btnFormImage"
                                                    class="btn btn-success btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-redo fa-sm text-white-50"></i>
                                    </span>
                                                <span class="text">
                                            Actualizar
                                    </span>
                                            </button>
                                            <a href="#" class="ml-2 link-delete">Borrar imagen</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('optional_scripts')
    <script src="{{ asset('vendors/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('vendors/jqueryLazy/jquery.lazy.min.js') }}"></script>
    <script>

        $(document).ready(function () {
            $('.lazy').Lazy({
                scrollDirection: 'vertical',
                effect: 'fadeIn',
            });

            // if ($(".item").toArray().length >= 1) {
            //     $(".container-alert").addClass('d-none');
            // }
            // ;


        });


        let myDropzone = new Dropzone('.dropzone', {
            url: '/admin/imagenes',
            acceptedFiles: 'image/jpg, image/jpeg, image/png',
            maxFilesize: 2,
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
                this.on("addedfile", function (file) {
                });
                this.on("complete", function (file) {

                });
                this.on("success", function (file, response) {
                    if ($(".item").toArray().length <= 0) {
                        $(".container-alert").addClass('d-none');
                        $('.grid').append(`<div class="item">
                            <img class="lazy thumbnail"
                                src="${response.url}"
                                data-src="${response.url}"
                                data-id="${response.id}"
                                data-toggle="modal"
                                data-target="#modalInfoImage" alt="imagen"/>
                     </div>`)
                    } else if ($(".item").toArray().length >= 1) {
                        $('.grid').children('.item').first()
                            .before(
                                `<div class="item">
                            <img class="lazy thumbnail"
                                src="${response.url}"
                                data-src="${response.url}"
                                data-id="${response.id}"
                                data-toggle="modal"
                                data-target="#modalInfoImage" alt="imagen"/>
                     </div>`);
                    }
                    ;
                });

                let itemsLength = $(".item").toArray().length;
                this.on("queuecomplete", function (file) {
                    if (itemsLength === 0) {
                        location.reload(true);
                    }else{
                        //myDropzone.removeAllFiles();
                    }
                });

                this.on("error", function (file, res) {
                    // myDropzone.removeAllFiles();
                    // myDropzone.removeFile(file);
                });
            },
        });

        Dropzone.autoDiscover = false;


        $('#btnOpenAddImages').click(function () {
            $("#container-DropZone").removeClass('d-none');
            $("#container-DropZone").addClass('d-flex');
            $(".container-noinfo").removeClass('d-flex');
            $(".container-noinfo").addClass('d-none');
        });

        $('#btnCloseAddImages').click(function () {
            $("#container-DropZone").removeClass('d-flex');
            $("#container-DropZone").addClass('d-none');
            $(".container-noinfo").removeClass('d-none');
            $(".container-noinfo").addClass('d-flex');
            myDropzone.removeAllFiles();
        });

        $('#modalInfoImage').on('show.bs.modal', function (e) {
            let link = $(e.relatedTarget),
                modal = $(this),
                id = link.data("id");
            axios({
                method: 'get',
                url: `/admin/imagenes/${id}`,
            })
                .then(function (response) {
                    modal.find("#image_id").val(response.data.id);
                    modal.find('#image_title').text(response.data.title == '' ? ' sin título ' : response.data.title);
                    modal.find('.thumbnail-image').attr("src", response.data.url);
                    modal.find('#title').val(response.data.title);
                    modal.find('#text_alt').val(response.data.text_alt);
                });
        });

        $('#modalInfoImage').on('hidden.bs.modal', function (e) {
            clearErrors();
        });


        (function () {
            document.querySelector('#FormImage').addEventListener('submit', function (e) {
                e.preventDefault();
                let id = document.querySelector('#image_id').value;
                axios({
                    method: 'put',
                    url: `/admin/imagenes/${id}`,
                    data: {
                        'id': id,
                        'title': document.querySelector('#title').value,
                        'text_alt': document.querySelector('#text_alt').value,
                    }
                }).then(function (response) {
                    const alert = document.querySelector('#alert_message');
                    alert.innerHTML = (`<div class="alert alert-success mt-2 alert-notifier" role="alert">Datos Actualizados.</div>`);
                    window.setTimeout(function () {
                        $(".alert-notifier").fadeTo(600, 0).slideUp(600, function () {
                            $(this).remove();
                        });
                    }, 1000);
                }).catch(function (error) {
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


        $(document).on('click', '.link-delete', function (e) {
            e.preventDefault();
            let id = document.querySelector('#image_id').value;
            axios({
                method: 'delete',
                url: `/admin/imagenes/${id}`,
            }).then(function (response) {
                $('#modalInfoImage').modal('toggle');
                $('[data-id="' + id + '"]')[0].parentElement.remove();
                if ($(".item").toArray().length === 0) {
                    location.reload(true);
                }
            }).catch(function (error) {
                console.log(error);
            });
        });


    </script>
@endpush
