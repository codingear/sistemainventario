@extends('admin.layouts._layout')
@section('title', 'Mi Perfil')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('admin.profile')}}">Mis Datos</a></li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Editar</li>
            </ol>
        </nav>
    </div>
    {{--    Page Heading--}}
    <div class="card shadow mb-4 mt-2 border-bottom-main">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-main">Editar mis datos</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form enctype="multipart/form-data" class="form-course needs-validation" novalidate method="POST"
                  action={{route('admin.updateAdminProfile',$user)}}
                      autocomplete="off" role="form">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-lg-6 col-md-12">
                        <label for="input-name" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :'' }}"
                               value="{{old('name',!empty($user) ? $user->name: '' )}}" id="input-name" name="name">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-6 col-md-12">
                        <label for="input-email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' :'' }}"
                               value="{{old('email',!empty($user) ? $user->email: '')}}" id="input-email" name="email">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-6 col-md-12">
                        <label for="input-password" class="col-form-label">Contraseña:</label>
                        <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' :'' }}"
                               value="{{old('password')}}" id="input-password" name="password">
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-lg-6 col-md-12">
                        <label for="input-password_confirmation" class="col-form-label">Confirmar contraseña:</label>
                        <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' :'' }}"
                               value="{{old('password_confirmation')}}" id="input-password_confirmation"
                               name="password_confirmation">
                    </div>

                </div>
                <div class="btn-action">
                    <button class="btn btn-success btn-icon-split btn-sm" type="submit">
                    <span class="icon text-white-50">
                        <i class="fas fa-save fa-sm text-white-50"></i>
                    </span>
                        <span class="text">Guardar</span>
                    </button>
                    <a href="{{route('admin.profile')}}" class="btn btn-secondary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-long-arrow-alt-left fa-sm text-white-50"></i>
                    </span>
                        <span class="text">Cancelar</span>
                    </a>
                </div>
            </form>
        </div>
    </div>






@endsection
