@extends('front.layouts._layout')
@section('title', 'Bienvenidos a Equibra') 
@section('styles') 
    <link rel="stylesheet" href="{{asset('css/_home.css')}}">
@stop
@section('content')
    <div class="container">
        <h1>Saludos desde marte</h1>
    </div>
@stop
@section('scripts')
    <script src="{{asset('js/home.js')}}"></script>
@stop