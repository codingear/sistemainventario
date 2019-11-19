@extends('front.layouts._layout')
@section('title', 'Bienvenidos a Equibra') 
@section('styles') 
<link rel="stylesheet" href="{{asset('css/_home.css')}}">
@stop

@section('content')
<br>
<div class="container section">
    <div class="columns is-multiline">
        @foreach ($products as $product)
            <div class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                <div class="card">
                    <div class="card-image">
                        <figure class="">
                            @if($product->principal_image == null)
                                <img
                                    src="https://dummyimage.com/300x300/EBEBEB/807d80.png&text=Imagen+del+Producto"
                                    class="cards__image">
                            @else
                                <img 
                                    src="{{url($product->image->url)}}" 
                                    alt="{{$product->name}}"
                                    class="cards__image">
                            @endif
                            @foreach($product->images as $image)
                                @if($image->is_principal===1)
                                    <img src="{{$image->url}}" alt="{{$product->name}}">
                                @endif
                            @endforeach
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <p class="title is-5">{{$product->name}}</p>
                            <p class="">Precio:&nbsp;<strong>{{$product->sale_price}}</strong></p>
                            <p>Stock:&nbsp;<strong>{{$product->stock}}</strong></p>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a href="#" class="card-footer-item has-text-grey"><i
                                class="far fa-eye fa-lg"></i></a>
                        <a href="#" class="card-footer-item has-text-grey"><i
                                class="fas fa-cart-arrow-down fa-lg"></i></a>
                    </footer>
                </div>
            </div>
        @endforeach
    </div>
    <br>
</div>
@stop

@section('scripts')
<script src="{{asset('js/home.js')}}"></script>
@stop