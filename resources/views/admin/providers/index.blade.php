@extends('admin.layouts._layout')
@section('title', 'Proveedores')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/dataTables/dataTables.bootstrap4.min.css')}}">
@endpush
@section('content')
    @if($providers->count()<=0)
        <div class="container-noinfo">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="container-noinfo_icon justify-content-center">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="container-noinfo_text justify-content-center">
                    <p>
                        Guarda la información de tus proveedores de insumos.
                    </p>
                    <a href="{{route('proveedores.create')}}" class="button-new">
                        Crear proveedor
                    </a>
                </div>

            </div>
        </div>
    @else
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
                        Proveedores
                    </li>
                </ol>
            </nav>
            <a href="{{route('proveedores.create')}}" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
            <i class="fas fa-plus-circle fa-sm text-white-50"></i>
        </span>
                <span class="text">
                Nuevo Proveedor
            </span>
            </a>
        </div>
        {{-- Page Heading--}}

        <div class="card shadow mt-2 mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-main">Listado de proveedores</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-providers" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Nombre Contacto</th>
                            <th>Email</th>
                            <th>Ciudad</th>
                            <th>Teléfono</th>
                            <th width="15%">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($providers as $provider)
                            <tr>
                                <td>{{$provider->name}}</td>
                                <td>{{$provider->contact_name}}</td>
                                <td>{{$provider->email}}</td>
                                <td>{{$provider->city}}</td>
                                <td>{{$provider->telephone}}</td>

                                <td class=" d-flex flex-wrap justify-content-center d-flex align-items-center">
                                    <a href="{{route('proveedores.show',$provider->id)}}"
                                       class="btn btn-circle btn-sm btn-info mx-1 mb-1" data-toggle="tooltip"
                                       data-placement="top" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{route('proveedores.edit',$provider->id)}}"
                                       class="btn btn-circle btn-sm btn-warning mx-1 mb-1" data-toggle="tooltip"
                                       data-placement="top" title="Editar">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <span data-toggle="modal" data-target="#deleteModal">
                                    <button type="button" class="btn btn-circle btn-sm btn-danger mx-1 mb-1"
                                            onclick="deleteData({{$provider->id}})" data-toggle="tooltip"
                                            data-placement="top" title="Eliminar">
                                        <i class="fa fa-fw fa-trash-alt"></i>
                                    </button>
                                </span>
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
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModal">¿Eliminar Proveedor?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Está acción es irreversible, borrarás el registro de forma permanente.
                        <input type="hidden" name="category_id" id="cat_id" value="">
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
    <script src="{{ asset('vendors/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#table-providers').dataTable({
                "ordering": true,
                "language": {
                    "url": "{{ asset('vendors/dataTables/Spanish.json')}}",
                },
                "pageLength": 10,
                order: [0, 'asc']
            });
            $('[data-toggle="tooltip"]').tooltip();
        });

        function deleteData($providerId) {
            let id = $providerId;
            let url = '{{ route("proveedores.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endpush
