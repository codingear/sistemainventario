<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials._metas')
    <title>{{ config('app.name', 'Equibra') }} - @yield('title') </title>
    <link href="{{ asset('css/store-style.css')}}" rel="stylesheet">
    <link href="{{ asset('vendors/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('img/favicon.ico')}}" rel="icon" type="image/png">
</head>

<body>
{{--Contenido Principal --}}
<main id="content-body">
    @yield ('content')
</main>
{{--Contenido Principal --}}

{{-- Footer --}}
<footer>
</footer>
{{-- Footer --}}
</body>

</html>
