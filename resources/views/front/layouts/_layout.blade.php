<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials._metas')
    @yield('styles')
    <link href="{{asset('img/favicon.ico')}}" rel="icon" type="image/png">
    <title>{{ config('app.name', 'Equibra') }} - @yield('title') </title>
</head>

<body>

@include('front.layouts._partials-mobile')

<div class="site-wrapper" id="content-body">

    @include ('front.layouts._header')

    @yield ('content')

    @include ('front.layouts._footer')
    
</div>
    

@yield('scripts')
</body>

</html>
