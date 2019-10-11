@extends('admin.layouts._layout')
@section('title', 'Mi Perfil')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="h5 breadcrumb-item"><a class="text-main" href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">Mis datos</li>
        </ol>
    </nav>
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

<div class="col-xl-4 col-md-6">
    <div class="card user-card user-card-3 support-bar1">
        <div class="card-body ">
            <div class="text-center">
                <div class="position-relative d-inline-block">
                    <img class="img-profile rounded-circle wid-150"
                        src="https://source.unsplash.com/lySzv_cqxH8/150x150" alt="User image">
                </div>
                <h3 class="mb-1 mt-3 f-w-400"> {{auth()->user()->name}}</h3>
                <p class="text-muted mb-0">{{auth::user()->roles->first()->name}}</p>
                <p class="text-muted"> {{auth()->user()->email}}</p>
            </div>
        </div>
        <div class="card-footer bg-light">
            <div class="row d-flex justify-content-md-end justify-content-sm-center">
                <a href="{{route('admin.editProfile')}}" class="btn btn-success btn-icon-split btn-sm">
                    <span class="text">Editar Datos</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
