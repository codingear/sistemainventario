@extends('front.layouts._layout-comingSoon')
@section('title', 'Inicio')
@section('content')
    <div class="container-logo bg-main d-flex align-items-center justify-content-center ">
        <img class="img-fluid main-logo" src="{{asset('img/thumbnail.png')}}" alt="">
        <p class="text-center main-text">
            ¡Próximamente!
        </p>
    </div>
@endsection
