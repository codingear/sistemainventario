@extends('admin.layouts._layout')
@section('title', 'Editar Administrador')
@push('stylesheets')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@endpush
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="h5 breadcrumb-item"><a class="text-main"
                    href="{{route('administradores.index')}}">Administradores</a>
            </li>
            <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Editar administrador</li>
        </ol>
    </nav>
</div>
<div class="card shadow mb-4 mt-2 border-bottom-main">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-main">Editar adiministrador</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Opciones:</div>
                <button onclick="deleteData({{$user->id}})" class="dropdown-item" data-toggle="modal"
                    data-target="#deleteModal">
                    Eliminar administrador
                </button>
            </div>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <form enctype="multipart/form-data" class="form-course needs-validation" novalidate method="POST"
            action={{route('administradores.update',$user)}} autocomplete="off" role="form">
            @csrf
            @method('PUT')
            @include('admin.administrators.partials._form')
        </form>
    </div>
</div>

{{--    Modal Delete Course--}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModal">¿Eliminar Registro?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Está acción es irreversible, borrarás el registro de forma permanente.
                    <input type="hidden" name="user_id" id="u_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, mantener el registro.
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Si, eliminar registro.
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--Modal--}}
@endsection
@push('optional_scripts')
<script>
    function deleteData(userId) {
            let id = userId;
            let url = '{{ route("administradores.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
</script>
@endpush