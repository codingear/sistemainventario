@extends('admin.layouts._layout')
@section('title', 'Productos')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/dataTables/dataTables.bootstrap4.min.css')}}">
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
                    <table class="table table-bordered table-hover" id="table-categories" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="30%">Nombre</th>
                            <th>Categoría</th>
                            <th width="5%">Stock</th>
                            <th width="15%">Precio venta</th>
                            <th width="5%">Status</th>
                            <th width="20%">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>{{empty($product->category->name) ? 'Sin Categoría' : $product->category->name}}
                                </td>
                                <td class="">
                                    <label class="badge badge-{{$product->stock<= 5 ? 'warning':'success'}}"
                                           style="font-size:.8rem;" data-toggle="tooltip" data-placement="top"
                                           title="{{$product->stock<= 5 ? 'Stock Bajo':''}}">
                                        {{$product->stock}}
                                    </label>
                                </td>
                                <td>${{$product->sale_price}}</td>
                                <td>
                                    <label class="badge badge-{{$product->status=== 'ACTIVO' ? 'success':'danger'}}">
                                        {{$product->status}}
                                    </label>
                                </td>
                                <td class="d-flex flex-wrap justify-content-center align-items-center">
                                    <a href="{{route('productos.edit',$product)}}"
                                       class="btn btn-circle btn-sm btn-warning mx-1 mb-1" data-toggle="tooltip"
                                       data-placement="top" title="Ver detalles/Editar">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="{{route('admin.editProductStatus',$product->id)}}"
                                       class='btn btn-circle btn-sm {{$product->status=== 'ACTIVO' ? 'btn-info':'btn-success'}} mx-1 mb-1'
                                       data-toggle="tooltip" data-placement="top"
                                       title="{{$product->status=== 'ACTIVO' ? 'Desactivar' :'Activar'}}"
                                       onclick="event.preventDefault(); document.getElementById('changeProductStatus-form').submit();">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    <form id="changeProductStatus-form"
                                          action="{{ route('admin.editProductStatus', $product->id) }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    <span data-toggle="modal" data-target="#deleteModal">
                                    <button type="button" class="btn btn-circle btn-sm btn-danger mx-1 mb-1"
                                            onclick="deleteData({{$product->id}})" data-toggle="tooltip"
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
@endsection

@push('optional_scripts')
    {{-- Modal Delete Course--}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModal">¿Eliminar Producto?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        El producto no será eliminado de forma permanente, pero ya no podrás ver sus detalles.
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
    <script src="{{ asset('vendors/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var table = $('#table-categories').dataTable({
                "ordering": true,
                "language": {
                    "url": "{{ asset('vendors/dataTables/Spanish.json')}}",
                },
                "pageLength": 10,
                "responsive": true,
                // order: [1, 'asc']
            });
            $('[data-toggle="tooltip"]').tooltip();
        });

        function deleteData(productId) {
            let id = productId;
            let url = '{{ route("productos.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }

        function clearErrors() {
            const errorMessages = document.querySelectorAll('.text-danger');
            errorMessages.forEach((element) => element.remove());
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach((element) => element.classList.remove('border', 'border-danger'))
        }

    </script>
@endpush
