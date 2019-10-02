<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials._metas')
    <title>{{ config('app.name', 'Equibra') }} - @yield('title') </title>
    <link href="{{ asset('css/all.css')}}" rel="stylesheet">
    <link href="{{asset('img/favicon.ico')}}" rel="icon" type="image/png">
</head>

<body class="bg-main">
    @yield ('content')
    <script src="{{asset('js/all.js')}}"></script>
    @stack('optional_scripts')
</body>

</html>