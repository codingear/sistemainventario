@extends('admin.layouts._layout')
@section('title', 'Nuevos Usuarios')
@push('stylesheets')
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@endpush
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('usuarios.index')}}">Usuarios</a></li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Editar Usuario</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow mb-4 mt-2 border-bottom-main">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-main">
                Editar Usuario
            </h6>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" class="form-course needs-validation" novalidate method="POST"
                  action={{route('usuarios.update',$user)}}
                      autocomplete="off" role="form">
                @csrf
                @method('PUT')
                @include('admin.users.partials._form')
            </form>
        </div>
    </div>
@endsection
@push('scripts_last')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
@endpush
