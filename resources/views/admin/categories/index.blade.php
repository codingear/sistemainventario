@extends('admin.layouts._layout')
@section('title', 'Categorías')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendors/dataTables/dataTables.bootstrap4.min.css')}}">
@endpush
@section('content')
    @if($categories->count()<=0)
        <div class="container-noinfo">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="container-noinfo_icon justify-content-center">
                    <i class="fas fa-cubes"></i>
                </div>
                <div class="container-noinfo_text justify-content-center">
                    <p>
                        Clasifica tus productos mediante categorías.
                    </p>
                    <a href="{{route('categorias.create')}}" class="button button-blue-primary">
                        Crear categoría
                    </a>
                </div>

            </div>
        </div>
    @else

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-start justify-content-between">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="h5 breadcrumb-item "><a class="text-main" href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Categorías</li>
                </ol>
            </nav>
            <a href="{{route('categorias.create')}}" class="button button-blue-primary">
                Nueva Categoría
            </a>
        </div>
        {{-- Page Heading--}}
        <div class="card shadow mt-2 mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-main">Listado de Categorías</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-categories" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th width="15%">Status</th>
                            <th width="10%">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{!empty($category->description) ? $category->description: 'Sin descripción.' }}</td>
                                <td>
                                    <label class="badge badge-{{$category->status=== 1 ? 'success':'danger'}}">
                                        {{$category->status=== 1 ? 'ACTIVO':'INACTIVO'}}
                                    </label>
                                </td>
                                <td class=" d-flex flex-wrap justify-content-center d-flex align-items-center">
                                    <a href="{{route('categorias.edit',$category->id)}}"
                                       class="btn btn-circle btn-sm btn-warning mx-1 mb-1" data-toggle="tooltip"
                                       data-placement="top" title="Editar">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <span data-toggle="modal" data-target="#deleteModal">
                                    <button type="button" class="btn btn-circle btn-sm btn-danger mx-1 mb-1"
                                            onclick="deleteData({{$category->id}})" >
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
                <form action="" id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <i class="fas fa-exclamation-circle"></i>
                        <div class="modal-body-text">
                            <p class="modal-body-text-title">Eliminar Categoria</p>
                            <p class="modal-body-text-msj">¿Estás seguro que quieres eliminar la categoría?. Si lo haces
                                perderás este registro de forma permanente.</p>
                        </div>
                        <input type="hidden" name="category_id" id="cat_id" value="">
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
    <script>
        $(document).ready(function () {
            $('#table-categories').dataTable({
                "ordering": true,
                "language": {
                    "url": "{{ asset('vendors/dataTables/Spanish.json')}}",
                },
                "pageLength": 10,
                order: [0, 'asc']
            });
            $('[data-toggle="tooltip"]').tooltip();
        });

        function deleteData(categoryId) {
            let id = categoryId;
            let url = '{{ route("categorias.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endpush
