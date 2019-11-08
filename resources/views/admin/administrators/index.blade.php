@extends('admin.layouts._layout')
@section('title', 'Administadores')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/dataTables/dataTables.bootstrap4.min.css')}}">
@endpush
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-start justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item ">
                    <a class="text-main" href="{{route('dashboard')}}">
                        Dashboard
                    </a>
                </li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">
                    Administradores
                </li>
            </ol>
        </nav>
        <a href="{{route('administradores.create')}}" class="button button-blue-primary">
            Crear Administrador
        </a>
    </div>
    {{--    Page Heading--}}

    @if($users->count()<=0)
        <div class="container mt-2 p-0">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading font-weight-bold">¡Sin Registros!</h4>
                <p>Aún no tienes ningún administrador agregado.</p>
                <hr>
                <p class="mb-0">¿Por qué no empiezar por agregar algunos?.</p>
            </div>
        </div>
    @else
        <div class="card shadow mt-2 mb-4">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-main mr-1">Listado de Administradores</h6>
                <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Ayuda"
                   data-content="Los administradores inactivos no tienen acceso al sistema.">
                    <i class="fas fa-question-circle info-img"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-administrators" width="100%"
                           cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th width="15%">Status</th>
                            <th width="20%">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->roles->first()->name}}</td>
                                <td>
                                    <label class="pill {{$user->status=== 1 ? 'pill--success':'pill pill--warning'}}">
                                        {{$user->status=== 1 ? 'Activo':'Inactivo'}}
                                    </label>
                                </td>
                                <td class=" d-flex flex-wrap justify-content-center d-flex align-items-center">
                                    @if($user->id!=1)
                                        <a href="{{route('administradores.edit',$user)}}"
                                           class="btn btn-circle btn-sm btn-warning mx-1 mb-1">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <span data-toggle="modal" data-target="#deleteModal">
                                    <button type="button" class="btn btn-circle btn-sm btn-danger mx-1 mb-1"
                                            onclick="deleteData({{$user->id}})">
                                        <i class="fa fa-fw fa-trash-alt"></i>
                                    </button>
                                    </span>
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
    {{-- Modal Delete Course--}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <i class="fas fa-exclamation-circle modal-icon"></i>
                        <div class="modal-body-text">
                            <p class="modal-body-text-title">Eliminar Categoria</p>
                            <p class="modal-body-text-msj">¿Estás seguro que quieres eliminar la categoría?. Si lo haces
                                perderás este registro de forma permanente.</p>
                        </div>
                        <input type="hidden" name="user_id" id="u_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button button-modal-cancel" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="button button-modal-danger" id="btnDeleteProvider">
                            <span>Eliminar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--Modal--}}

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
            $(function () {
                $('[data-toggle="popover"]').popover()
            })
        });

        function deleteData(userId) {
            let id = userId;
            let url = '{{ route("administradores.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        $("#deleteForm").submit(function (ev) {
            ev.preventDefault();
            let btn = document.querySelector("#btnDeleteProvider");
            disableSubmit(btn, 'Eliminando');
            var data = new FormData(this);
            axios.delete(this.action, data)
                .then((response) => {
                    enableSubmit(btn, 'Eliminar');
                    const res = response.data;
                    $("#deleteModal").modal('hide');
                    $('button[type=submit]').prop('disabled', false);
                    shootAlert('success', 'Administrador eliminado', res.msg);
                    window.setTimeout(function () {
                        location.reload(true);
                    }, 1200);
                })
                .catch((error) => {
                    enableSubmit(btn, 'Eliminar');
                    const errors = error.response.data;
                    $("#deleteModal").modal('hide');
                    $('#deleteModal').on('hidden.bs.modal', function (e) {
                        $('button[type=submit]').prop('disabled', false);
                        shootAlert('error', 'Ups. Algo salió mal.', errors);
                    })
                }).finally(() => {
                enableSubmit(btn, 'Eliminar');
            })
        });
    </script>
@endpush
