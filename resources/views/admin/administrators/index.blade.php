@extends('admin.layouts._layout')
@section('title', 'Usuarios')
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('vendors/dataTables/dataTables.bootstrap4.min.css')}}">
@endpush
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-start justify-content-between">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="h5 breadcrumb-item "><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Administradores</li>
        </ol>
    </nav>
    <a href="{{route('administradores.create')}}" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
            <i class="fas fa-plus-circle fa-sm text-white-50"></i>
        </span>
        <span class="text">Nuevo Administrador</span>
    </a>
</div>
{{--    Page Heading--}}

@if (session()->has('info'))
<div class="alert-notifier alert alert-success mt-2" role="alert">
    <strong>Muy bien.</strong> {{session('info')}}
</div>
@endif
@if (session()->has('error'))
<div class="alert-notifier alert alert-danger mt-2" role="alert">
    <strong>Ops¡</strong> {{session('error')}}
</div>
@endif
@if($users->count()<=0) <div class="container mt-2 p-0">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4 class="alert-heading font-weight-bold">¡Sin Registros!</h4>
        <p>Aún no tienes ningún administrador agregado.</p>
        <hr>
        <p class="mb-0">¿Por qué no empiezar por agregar algunos?.</p>
    </div>
    </div>
    @else
    <div class="card shadow mt-2 mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-main">Listado de Administradores</h6>
            <p class="text-danger font-weight-bold font-italic" style="font-size: 13px;">
                *Recuerda que los administradores inactivos no tienen acceso al sistema.
            </p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="table-administrators" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th width="15%">Status</th>
                            <th width="10%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->roles->first()->name}}</td>
                            <td>
                                <label class="badge badge-{{$user->status=== 1 ? 'success':'danger'}}">
                                    {{$user->status=== 1 ? 'ACTIVO':'INACTIVO'}}
                                </label>
                            </td>
                            <td class=" d-flex flex-wrap justify-content-center d-flex align-items-center">
                                @if($user->id!=1)
                                <a href="{{route('administradores.edit',$user)}}"
                                    class="btn btn-circle btn-sm btn-warning mx-1 mb-1" data-toggle="tooltip"
                                    data-placement="top" title="Editar">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="{{route('admin.editAdminStatus',$user)}}"
                                    class='btn btn-circle btn-sm {{$user->status ? 'btn-danger ' :'btn-success'}} mx-1 mb-1'
                                    data-toggle="tooltip" data-placement="top"
                                    title="{{$user->status ? 'Desactivar' :'Activar'}}" onclick="event.preventDefault();
                                           document.getElementById('changeStatus-form').submit();">
                                    <i class="fa fa-fw {{$user->status ? 'fa-times' :'fa-check'}}"></i>
                                </a>
                                <form id="changeStatus-form" action="{{ route('admin.editAdminStatus', $user->id) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @endif
    @endsection

    @push('optional_scripts')
    <script src="{{ asset('vendors/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#table-administrators').dataTable({
                "ordering": true,
                "language": {
                    "url": "{{ asset('vendors/dataTables/Spanish.json')}}",
                },
                "pageLength": 10,
                order: [1, 'asc']
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @endpush