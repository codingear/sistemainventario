@extends('admin.layouts._layout')
@section('title', 'Mi Perfil')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Mis datos</li>
            </ol>
        </nav>
    </div>
    {{--    Page Heading--}}
    <div id="alert_message">
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="card user-card user-card-3 support-bar1">
            <div class="card-body ">
                <div class="text-center">
                    {{--                <div class="position-relative d-inline-block">--}}
                    {{--                    <img class="img-profile rounded-circle wid-150"--}}
                    {{--                        src="https://source.unsplash.com/lySzv_cqxH8/150x150" alt="User image">--}}
                    {{--                </div>--}}
                    <div class="form-row d-flex justify-content-center">
                        <div class="avatar-upload">

                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg"/>
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview"
                                     style="background-image: url({{auth::user()->avatar}});">
                                </div>
                            </div>
                            <span class="text-error"></span>
                        </div>
                    </div>
                    <h3 class="mb-1 mt-3 f-w-400"> {{auth()->user()->name}}</h3>
                    <p class="text-muted mb-0">{{auth::user()->roles->first()->name}}</p>
                    <p class="text-muted"> {{auth()->user()->email}}</p>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="row d-flex justify-content-md-end justify-content-sm-center">
                    <a href="{{route('admin.editProfile')}}" class="button button-blue-primary">
                        Editar Datos
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('optional_scripts')
    <script>
        $(function () {
            $(document).on('change', '#imageUpload', function (e) {
                let files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) {
                    let sizeImg = files[0].size / 1024;
                    let reader = new FileReader();

                    reader.readAsDataURL(files[0]);

                    let data = new FormData();
                    data.append('avatar', e.target.files[0]);
                    data.append('_method', 'PATCH');

                    if (sizeImg <= 2048) {
                        reader.onloadend = function (e) {
                            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                            $('#imagePreview').hide();
                            $('#imagePreview').fadeIn(650);
                        };
                        axios({
                            method: 'post',
                            url: '/admin/update_avatar',
                            data: data,
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{csrf_token()}}'
                            }
                        })
                            .then(function (response) {
                                const alert = document.querySelector('#alert_message');
                                alert.innerHTML = (`<div class="alert alert-success mt-2 alert-notifier" role="alert">Imagen Actualizada.</div>`);
                                window.setTimeout(function () {
                                    $(".alert-notifier").fadeTo(600, 0).slideUp(600, function () {
                                        $(this).remove();
                                    });
                                }, 1000);
                                window.setTimeout(function () {
                                    window.location.reload(true);
                                }, 500);
                            })
                            .catch(function (error) {
                                const alert = document.querySelector('#alert_message');
                                alert.innerHTML = (`<div class="alert danger mt-2 alert-notifier" role="alert">error.</div>`);
                                window.setTimeout(function () {
                                    $(".alert-notifier").fadeTo(600, 0).slideUp(600, function () {
                                        $(this).remove();
                                    });
                                }, 1000);
                            });
                    } else {
                        $(".text-error").text("Imagen mayor a 2Mb");
                    }
                } else {
                    $(".text-error").text("Archivo no válido.");
                }
            });
        });
    </script>
@endpush

