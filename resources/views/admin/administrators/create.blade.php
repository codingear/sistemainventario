@extends('admin.layouts._layout')
@section('title', 'Nuevo Administrador')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-select/bootstrap-select.min.css') }}">
@endpush
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="h5 breadcrumb-item"><a class="text-main"
                                                  href="{{route('administradores.index')}}">Administradores</a></li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Nuevo Administrador</li>
            </ol>
        </nav>
    </div>
    <div class="card shadow mb-4 mt-2 border-bottom-main">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-main">
                Nuevo Administrador
            </h6>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" class="form-course needs-validation" novalidate method="POST"
                  action={{route('administradores.store')}} autocomplete="off" role="form">
                @csrf
                @include('admin.administrators.partials._form')
            </form>
        </div>
    </div>
@endsection
@push('optional_scripts')
    <script src="{{ asset('vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
@endpush
