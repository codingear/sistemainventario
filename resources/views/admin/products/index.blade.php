@extends('admin.layouts._layout')
@section('title', 'Productos')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/dataTables/dataTables.bootstrap4.min.css')}}">
    
    <link rel="stylesheet" href="{{ asset('vendors/dataTables/responsive.dataTables.min.css')}}"> 
    <link rel="stylesheet" href="{{ asset('vendors/dataTables/responsive.bootstrap4.min.css')}}">
@endpush
@section('content')
    {{-- Page Heading --}}
    <div class="d-sm-flex align-items-start justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item "><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Productos</li>
            </ol>
        </nav>
        <a href="{{route('productos.create')}}"class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
            <i class="fas fa-plus-circle fa-sm text-white-50"></i>
        </span>
            <span class="text text-light">Nuevo Producto</span>
        </a>
    </div>
    {{--    Page Heading--}}
    @if($products->count()<=0)
        <div class="container mt-2 p-0">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h4 class="alert-heading font-weight-bold">¡Sin Registros!</h4>
                <p>Aún no tienes ningún producto agregado.</p>
            </div>
        </div>
    @else
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
@endsection

@push('optional_scripts')

    {{-- Modal Delete Course--}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">¿Eliminar Producto?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        El producto no será eliminado de forma permanente, pero ya no podrás ver sus detalles.
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

    {{-- Modal --}}

    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/admin/')) !!}
    </script>
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
                    url: '/admin/all_productos',
                    dataSrc: '',
                },
                "columns": [
                    { 
                        "data": "image.url", 
                        render: function(data, type, row){
                            if(data == null || data == undefined){
                                return "<img class='img-table' src='https://dummyimage.com/50x50/f8f9fc/363537.png&text=Sin+Imagen'>";
                            }else{
                                return "<img class='img-table' src='"+data+"'>";
                            }
                        }
                    },
                    { 
                        "data": "name",
                        render: function(data, type, row){
                            return "<p class='table-product table-cell-text'>"+data+"</p><p>"+row.sku+"</p>";
                        }
                    },
                    { 
                        "data": "stock",
                        render: function(data, type, row){
                            return "<p class='table-cell-text'><strong>"+data+"</strong></p><p>Unidades</p>";
                        }
                    },
                    { 
                        "data": "sale_price",
                        render: function(data, type, row){
                            return "<p class='table-cell-text'><strong>$" + data +"</strong></p><p>MXN</p>";
                        }
                    },
                    { 
                        "data": "status",
                        render: function(data, type, row){
                            var txt = data.toLowerCase();
                            txt = txt.charAt(0).toUpperCase() + txt.slice(1);
                            if(txt == 'Activo'){
                                return "<span class='pill pill--success'>"+txt+"</span>";
                            }else if(txt == 'Inactivo'){
                                return "<span class='pill pill--warning'>"+txt+"</span>";
                            }else{
                                return "<span class='pill'>"+txt+"</span>";
                            }
                        }
                    },
                    {
                        "data": null,
                        render: function ( data, type, row ) {
                            $tmp = `
                                <a href='javascript:void(0);' class='control-button'><i class='far fa-eye fa-lg'></i></a>
                                <a href='${APP_URL}/productos/${row.id}/editar' class='control-button'><i class='far fa-edit fa-lg'></i></a>
                                <button id="showMod" onclick='deleteData(${row.id})' class='control-button' data-toggle="modal" data-target="#deleteModal" data-placement="top"><i class='far fa-trash-alt fa-lg'></i></button>
                            `;
                            return $tmp;
                        }
                    }
                ],
            });
       
            var scope;
            
            $('#t-products tbody').on( 'click', 'button#showMod', function () {
                scope = this;
            });

            $("#deleteForm").submit(function(ev){
                ev.preventDefault();
                $('button[type=submit]').prop('disabled', true);
                var data = new FormData(this);
                console.log(this.action);
                axios.delete(this.action,data)
                    .then(function(response){
                        const res = response.data;
                        $("#deleteModal").modal('hide');
                        $('button[type=submit]').prop('disabled', false);
                        shootAlert("success",res.msg);
                        var row = $(scope).parents('tr');
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


        function shootAlert(type, msg){
            let tmp = ``;
            if(type == "success"){
                tmp = `
                    <div class="alert alert-positive alert-notifier alert-dismissible fade show">
                        <div class="alert-body">
                        <div class="alert-icon icon-positive">
                            <i class="far fa-check-circle"></i>
                        </div>
                        <div class="alert-msj">
                            <p class="alert-title">${msg}</p>
                            <p class="alert-text">El registro se ha eliminado con exito</p>
                        </div>
                        </div>
                    </div>
                `;
            }else if(type== "error"){
                tmp = `
                    <div class="alert alert-negative alert-notifier alert-dismissible fade show">
                        <div class="alert-body">
                        <div class="alert-icon icon-negative">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="alert-msj">
                            <p class="alert-title">Ups, algo ha salido mal</p>
                            <p class="alert-text">${msg}.</p>
                        </div>
                        </div>
                    </div>
                `;
            }

            $("body").prepend(tmp);
            setTimeout(function () {
                $(".alert-notifier").fadeTo(600, 0).slideUp(600, function () {
                    $(this).remove();
                });
            }, 2000);
        }

        function deleteData(productId) {
            let id = productId;
            let url = '{{ route("productos.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }   
    </script>
@endpush
