@extends('admin.layouts._layout')
@section('title', 'Usuarios')
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('vendors/dataTables-1.10.18/dataTables.bootstrap4.min.css')}}">
@endpush
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-start justify-content-between">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="h5 breadcrumb-item "><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Usuarios</li>
        </ol>
    </nav>

    <a href="{{route('usuarios.create')}}" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
            <i class="fas fa-plus-circle fa-sm text-white-50"></i>
        </span>
        <span class="text">Nuevo Usuario</span>
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
@if($users->count()<=0) <div class="container menu-cursos mt-2">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4 class="alert-heading font-weight-bold">¡Sin Registros!</h4>
        <p>Aún no tienes ningún usuario agregado.</p>
        <hr>
        <p class="mb-0">¿Por qué no empiezar por agregar algunos?.</p>
    </div>
    </div>
    @else
    <div class="card shadow mt-2 mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-main">Listado de Usuarios</h6>
            <p class="text-danger font-weight-bold font-italic" style="font-size: 13px;">
                *Recuerda que los usuarios inactivos no tienen acceso al sistema.
            </p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="table-users" width="100%" cellspacing="0">
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
                                    {{$user->status=== 1 ? 'Activo':'Inactivo'}}
                                </label>
                            </td>

                            <td class=" d-flex flex-wrap justify-content-center d-flex align-items-center">
                                @if($user->id!=1)
                                <a href="{{route('usuarios.edit',$user)}}"
                                    class="btn btn-circle btn-sm btn-warning mx-1 mb-1">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button onclick="deleteData({{$user->id}})"
                                    class='btn btn-circle btn-sm btn-danger mx-1 mb-1' data-toggle="modal"
                                    data-target="#deleteModal">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
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
    {{--    Modal Delete Course--}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Eliminar Registro?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Está acción es irreversible, borrarás el registro de forma permanente.
                        <input type="hidden" name="profession_id" id="prof_id" value="">
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
    <script src="{{ asset('vendors/dataTables-1.10.18/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/dataTables-1.10.18/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#table-users').dataTable({
                "ordering": true,
                "language": {
                    "url": "{{ asset('vendors/dataTables-1.10.18/Spanish.json')}}",
                },
                "pageLength": 10,
                order:[0,'asc']
            });
        });

        function deleteData(userId) {
            let id = userId;
            let url = '{{ route("usuarios.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
    @endpush
