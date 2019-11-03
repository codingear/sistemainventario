@extends('admin.layouts._layout')
@section('title', 'Nueva Categoría')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('categorias.index')}}">Categorías</a></li>
            <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Nueva Categoría</li>
        </ol>
    </nav>
</div>
<div class="card shadow mb-4 mt-2 border-bottom-main">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-main">
            Nueva Categoría
        </h6>
    </div>
    <div class="card-body">
        <form enctype="multipart/form-data" class="form-course needs-validation" novalidate method="POST"
            action={{route('categorias.store')}} autocomplete="off" role="form">
            @csrf
            @include('admin.categories.partials._form')
        </form>
    </div>
</div>
@endsection
