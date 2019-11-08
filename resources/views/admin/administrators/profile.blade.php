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

    <div class="d-flex justify-content-center">

        <div class="card user-card">
            <div class="card-body ">
                <div class="d-flex justify-content-center card-body_image">
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
                <div class="card-body_text">
                    <p class="my-0 user-card_name"> {{auth()->user()->name}}</p>
                    <p class="text-main my-0">{{auth::user()->roles->first()->name}}</p>
                    <p class="user-card_text my-0"> {{auth()->user()->email}}</p>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="row d-flex justify-content-end">
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
                            $('#profile-image').attr('src', e.target.result);
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
                                shootAlert('success', 'Foto actualizada', response.data.msg);
                            })
                            .catch(function (error) {
                                shootAlert('error', 'Foto no actualizada', error.response.data);
                            });
                    } else {
                        shootAlert('error', 'Foto no actualizada', 'Imagen mayor a 2Mb');
                    }
                } else {
                    shootAlert('error', 'Foto no actualizada', 'Archivo no válido');
                }
            });
        });

    </script>
@endpush

