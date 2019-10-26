@extends('admin.layouts._layout')
@section('title', 'Ver Proveedor')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="h5 breadcrumb-item">
                    <a class="text-main" href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="h5 breadcrumb-item">
                    <a class="text-main" href="{{route('proveedores.index')}}">Proveedores
                    </a>
                </li>
                <li class="h5 breadcrumb-item text-gray-800 active" aria-current="page">
                    Ver Proveedor
                </li>
            </ol>
        </nav>
    </div>

    <div class="card shadow mb-4 mt-2 border-bottom-main">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-main">Detalles de Proveedor</h6>
            <a href="{{route('proveedores.edit',$provider->id)}}" class="button-new">
                Editar proveedor
            </a>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <label class="col-sm-2  font-weight-bolder">Nombre Proveedor</label>
                    <div class="col-sm-10">
                        {{$provider->name}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2  font-weight-bolder">Nombre Contacto</label>
                    <div class="col-sm-10">
                        {{$provider->contact_name}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2  font-weight-bolder">RFC</label>
                    <div class="col-sm-10">
                        {{$provider->rfc}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2  font-weight-bolder">Teléfono</label>
                    <div class="col-sm-10">
                        {{$provider->telephone}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2  font-weight-bolder">Email</label>
                    <div class="col-sm-10">
                        {{$provider->email}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2  font-weight-bolder">Sitio Web</label>
                    <div class="col-sm-10">
                        {{$provider->website}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2  font-weight-bolder">Estado</label>
                    <div class="col-sm-10">
                        {{$provider->state->name}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2  font-weight-bolder">Ciudad</label>
                    <div class="col-sm-10">
                        {{$provider->city}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2  font-weight-bolder">Dirección</label>
                    <div class="col-sm-10">
                        {{$provider->address}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2  font-weight-bolder">Código Postal</label>
                    <div class="col-sm-10">
                        {{$provider->zip_code}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2  font-weight-bolder">Notas</label>
                    <div class="col-sm-10">
                        {{$provider->notes}}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
