@extends('admin.layouts._layout')
@section('title', 'Categorías')
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('vendors/dataTables-1.10.18/dataTables.bootstrap4.min.css')}}">
@endpush
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-start justify-content-between">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="h5 breadcrumb-item "><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Categorías</li>
        </ol>
    </nav>
    <a href="{{route('categorias.create')}}" class="btn btn-success btn-icon-split btn-sm">
        <span class="icon text-white-50">
            <i class="fas fa-plus-circle fa-sm text-white-50"></i>
        </span>
        <span class="text">Nueva Categoría</span>
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
@if($categories->count()<=0) <div class="container menu-cursos mt-2">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4 class="alert-heading font-weight-bold">¡Sin Registros!</h4>
        <p>Aún no tienes ninguna categoría agregada.</p>
    </div>
    </div>
    @else
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
                                <a href="{{route('admin.editAdminStatus',$category)}}"
                                    class='btn btn-circle btn-sm {{$category->status ? 'btn-danger ' :'btn-success'}} mx-1 mb-1'
                                    data-toggle="tooltip" data-placement="top"
                                    title="{{$category->status ? 'Desactivar' :'Activar'}}" onclick="event.preventDefault();
                                           document.getElementById('changeStatus-form').submit();">
                                    <i class="fa fa-fw {{$category->status ? 'fa-times' :'fa-check'}}"></i>
                                </a>
                                <form id="changeStatus-form"
                                    action="{{ route('admin.category.changeStatus', $category->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('PUT')
                                </form>
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
    <script src="{{ asset('vendors/dataTables-1.10.18/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/dataTables-1.10.18/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#table-categories').dataTable({
                "ordering": true,
                "language": {
                    "url": "{{ asset('vendors/dataTables-1.10.18/Spanish.json')}}",
                },
                "pageLength": 10,
                order: [0, 'asc']
            });

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @endpush