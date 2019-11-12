@extends('admin.layouts._layout')
@section('title', 'Proveedores')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/dataTables/dataTables.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/dataTables/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/dataTables/responsive.bootstrap4.min.css')}}">
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
                    <a href="{{route('proveedores.create')}}" class="button button-blue-primary">
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
            <a href="{{route('proveedores.create')}}" class="button button-blue-primary">
                Crear proveedor
            </a>
        </div>
        {{-- Page Heading--}}

        <div class="card shadow mt-2 mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-main">Listado de proveedores</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive table-custom">
                    <table class="table" id="table-providers" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>NOMBRE PROVEEDOR</th>
                            <th>EMAIL</th>
                            <th>RFC</th>
                            <th>TELEFONO</th>
                            <th>FECHA ALTA</th>
                            <th width="15%">ACCIONES</th>
                        </tr>
                        </thead>
                        <tbody>

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
                        <i class="fas fa-exclamation-circle"></i>
                        <div class="modal-body-text">
                            <p class="modal-body-text-title">Eliminar Proveedor</p>
                            <p class="modal-body-text-msj">¿Estás seguro que quieres eliminar el proveedor?. Si lo haces
                                perderás este registro de forma permanente.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button button-modal-cancel" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="button button-modal-danger">
                            Eliminar registro.
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
    <script src="{{ asset('vendors/moment/moment-with-locales.min.js') }}"></script>

    <script src="{{ asset('vendors/dataTables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/dataTables/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            var scope;

            var table = $('#table-providers').DataTable({
                "ordering": true,
                "language": {
                    "url": "{{ asset('vendors/dataTables/Spanish.json')}}",
                },
                "pageLength": 10,
                "responsive": true,
                "ajax": {
                    url: APP_URL + '/all_providers',
                    dataSrc: '',
                },
                "columns": [
                    {
                        "data": "name",
                        render: function (data, type, row) {
                            return `
                                <p class="table-product table-cell-text">${data}</p>
                                <p class='table-cell-text'>${row.contact_name}</p>
                            `;
                        }
                    },
                    {"data": "email"},
                    {"data": "rfc"},
                    {"data": "telephone"},
                    {
                        "data": "created_at",
                        render: function (data, type, row) {
                            if (type === "sort" || type === "type") {
                                return data;
                            }
                            moment.locale('es');
                            return "<p class='table-cell-text'><strong>" + moment(data).format("DD-MM-YYYY") + "</strong></p><p class='table-cell-text'>" + moment(data).format("HH:mm a") + "</p>";
                        }
                    },
                    {
                        "data": null,
                        render: function (data, type, row) {
                            $tmp = `
                                <a href='${APP_URL}/proveedores/${row.id}' class='control-button'><i class='far fa-eye fa-lg'></i></a>
                                <a href='${APP_URL}/proveedores/${row.id}/editar' class='control-button'><i class='far fa-edit fa-lg'></i></a>
                                <button id="showMod" onclick='deleteData(${row.id})' class='control-button' data-toggle="modal" data-target="#deleteModal" data-placement="top"><i class='far fa-trash-alt fa-lg'></i></button>
                            `;
                            return $tmp;
                        }
                    }
                ],
                initComplete: function () {
                    this.api().on( 'draw', function () {
                        console.log($(this).find('tbody tr').length);
                        if($(this).find('tbody tr td').first().attr('colspan')){
                            window.location.replace(APP_URL + '/proveedores');
                        }
                    });
                }
            });
                
            $('#table-providers tbody').on( 'click', 'button#showMod', function () {
                scope = this;
            });
            
            $("#deleteForm").submit(function(ev){
                ev.preventDefault();
                $('button[type=submit]').prop('disabled', true);
                var data = new FormData(this);
                axios.delete(this.action,data)
                    .then(function(response){
                        const res = response.data;
                        $("#deleteModal").modal('hide');
                        $('button[type=submit]').prop('disabled', false);
                        shootAlert("success",res.msg);
                        var row;
                        if($(scope).closest('table').hasClass("collapsed")) {
                            var child = $(scope).parents("tr.child");
                            row = $(child).prev(".parent");
                            console.log(row);
                        } else {
                            row = $(scope).parents('tr');
                        }
                        row.fadeOut(600, function () {
                            table.row(row).remove().draw();
                        });
                    })
                    .catch(function(error){
                        const errors = error.response.data;
                        $("#deleteModal").modal('hide');
                        $('#deleteModal').on('hidden.bs.modal', function (e) {
                            $('button[type=submit]').prop('disabled', false);
                            shootAlert("error",errors);
                        })
                });
            });
        });
        function deleteData($providerId) {
            let id = $providerId;
            let url = '{{ route("proveedores.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

    </script>
@endpush
