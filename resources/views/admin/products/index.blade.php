@extends('admin.layouts._layout')
@section('title', 'Productos')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/dataTables/dataTables.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{ asset('vendors/dataTables/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/dataTables/responsive.bootstrap4.min.css')}}">
@endpush
@section('content')
    @if($products->count()<=0)
        <div class="container-noinfo">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="container-noinfo_icon justify-content-center">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="container-noinfo_text justify-content-center">
                    <p>
                        Crea tu primer producto y dalo a conocer al mundo.
                    </p>
                    <a href="{{route('productos.create')}}" class="button button-blue-primary">
                        Crear producto
                    </a>
                </div>

            </div>
        </div>
    @else
        {{-- Page Heading --}}
        <div class="d-sm-flex align-items-start justify-content-between">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="h5 breadcrumb-item "><a class="text-main" href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Productos</li>
                </ol>
            </nav>
            <a href="{{route('productos.create')}}" class="button button-blue-primary">
                Crear producto
            </a>
        </div>
        {{--    Page Heading--}}

        <div class="card shadow mt-2 mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-main">Listado de Productos</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-custom" id="t-products" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="10%">IMAGEN</th>
                            <th width="40%">NOMBRE / SKU</th>
                            <th width="10%">EXISTENCIAS</th>
                            <th width="10%">PRECIO</th>
                            <th width="10%">ESTADO</th>
                            <th width="20%">ACCIONES</th>
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
                        <i class="fas fa-exclamation-circle modal-icon"></i>
                        <div class="modal-body-text">
                            <p class="modal-body-text-title">Eliminar Producto</p>
                            <p class="modal-body-text-msj">¿Estás seguro que quieres eliminar el producto?. No se
                                eliminara de forma permanente pero no podrás acceder a sus detalles.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button button-modal-cancel" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="button button-modal-danger" id="btnDeleteProduct">
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

    <script src="{{ asset('vendors/dataTables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/dataTables/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var table = $('#t-products').DataTable({
                "ordering": true,
                "language": {
                    "url": "{{ asset('vendors/dataTables/Spanish.json')}}",
                },
                "pageLength": 10,
                "responsive": true,
                "ajax": {
                    url: APP_URL + '/all_productos',
                    dataSrc: '',
                },
                "columns": [
                    {
                        "data": "image.url",
                        render: function (data, type, row) {
                            if (data == null || data == undefined) {
                                return "<img class='img-table' src='https://dummyimage.com/50x50/f8f9fc/363537.png&text=Sin+Imagen'>";
                            } else {
                                return "<img class='img-table' src='" + data + "'>";
                            }
                        }
                    },
                    {
                        "data": "name",
                        render: function (data, type, row) {
                            return "<p class='table-product table-cell-text'>" + data + "</p><p>" + row.sku + "</p>";
                        }
                    },
                    {
                        "data": "stock",
                        render: function (data, type, row) {
                            return "<p class='table-cell-text'><strong>" + data + "</strong></p><p>Unidades</p>";
                        }
                    },
                    {
                        "data": "sale_price",
                        render: function (data, type, row) {
                            return "<p class='table-cell-text'><strong>$" + data + "</strong></p><p>MXN</p>";
                        }
                    },
                    {
                        "data": "status",
                        render: function (data, type, row) {
                            var txt = data.toLowerCase();
                            txt = txt.charAt(0).toUpperCase() + txt.slice(1);
                            if (txt == 'Publicado') {
                                return "<span class='pill pill--success'>" + txt + "</span>";
                            } else if (txt == 'Inactivo') {
                                return "<span class='pill pill--warning'>" + txt + "</span>";
                            } else {
                                return "<span class='pill'>" + txt + "</span>";
                            }
                        }
                    },
                    {
                        "data": null,
                        render: function (data, type, row) {
                            $tmp = `
                                <a href='javascript:void(0);' class='control-button'><i class='far fa-eye fa-lg'></i></a>
                                <a href='${APP_URL}/productos/${row.id}/editar' class='control-button'><i class='far fa-edit fa-lg'></i></a>
                                <button id="showMod" onclick='deleteData(${row.id})' class='control-button' data-toggle="modal" data-target="#deleteModal" data-placement="top"><i class='far fa-trash-alt fa-lg'></i></button>
                            `;
                            return $tmp;
                        }
                    }
                ],
                initComplete: function () {
                    this.api().on('draw', function () {
                        console.log($(this).find('tbody tr').length);
                        if ($(this).find('tbody tr td').first().attr('colspan')) {
                            window.location.replace(APP_URL + '/productos');
                        }
                    });
                }
            });

            var scope;

            $('#t-products tbody').on('click', 'button#showMod', function () {
                scope = this;
            });

            $("#deleteForm").submit(function (ev) {
                ev.preventDefault();
                let btn = document.querySelector("#btnDeleteProduct");
                disableSubmit(btn);
                var data = new FormData(this);
                axios.delete(this.action, data)
                    .then((response) => {
                        enableSubmit(btn);
                        const res = response.data;
                        $("#deleteModal").modal('hide');
                        shootAlert('success', 'Producto eliminado', res.msg);
                        var row;
                        if ($(scope).closest('table').hasClass("collapsed")) {
                            var child = $(scope).parents("tr.child");
                            row = $(child).prev(".parent");
                        } else {
                            row = $(scope).parents('tr');
                        }
                        row.fadeOut(600, function () {
                            table.row(row).remove().draw();

                        });
                    })
                    .catch((error) => {
                        enableSubmit(btn);
                        const errors = error.response.data;
                        $("#deleteModal").modal('hide');
                        $('#deleteModal').on('hidden.bs.modal', function (e) {
                            shootAlert('error', 'Ups. Algo salió mal.', errors);
                        })
                    })
                    .finally(() => {
                        enableSubmit(btn);
                    });
            });
        });

        function deleteData(productId) {
            let id = productId;
            let url = '{{ route("productos.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function disableSubmit(btn) {
            btn.style.opacity = ".5";
            btn.disabled = true;
            btn.innerHTML = `<span>Eliminando</span> <i class="fas fa-circle-notch fa-spin"></i>`;
        }

        function enableSubmit(btn) {
            btn.style.opacity = 'initial';
            btn.disabled = false;
            btn.innerHTML = `<span>Eliminar</span>`;
        }
    </script>
@endpush
