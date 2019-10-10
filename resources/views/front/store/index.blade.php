@extends('front.store.layouts._layout')
@section('title', 'Tienda Equibra')
@section('content')
    <nav class="navbar is-light is-fixed-top" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="#">
                <img src="{{asset('img/brand_black.png')}}" alt="Logo Equibra">
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
               data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item">
                    Principal
                </a>

                <a class="navbar-item">
                    Nosotros
                </a>
                <a class="navbar-item">
                    Franquicias
                </a>
                <a class="navbar-item">
                    Productos
                </a>
                <a class="navbar-item">
                    Contacto
                </a>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary">
                            <strong>Registrarse</strong>
                        </a>
                        <a class="button">
                            Ingresar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container is-fluid wrapper contenedor">
        <div class="columns">
            <aside class="column is-full-tablet is-2-desktop menu aside">
                <div class="fixed-c">
                    <div class="brand">
                        <img src="{{asset('img/brand_black.png')}}" alt="Logo Equibra">
                    </div>
                    <p class="menu-label">
                        Navegación Categorías
                    </p>
                    <ul class="menu-list">
                        @foreach ($categories as $category)
                            <li>
                                <a class="" href="">{{$category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
            <div class="column is-full-tablet is-10-desktop">
                <div class="container is-fluid section">
                    <div class="columns is-multiline">
                        @foreach ($products as $product)
                            <div class="column is-half-tablet is-one-third-desktop is-one-quarter-widescreen">
                                <div class="card">
                                    <div class="card-image">
                                        <figure class="image is-4by3">
                                            <img
                                                src="{{empty($product->images->first()->url) ? 'https://bulma.io/images/placeholders/1280x960.png' : $product->images->first()->url}}"
                                                alt="Placeholder image">
                                        </figure>
                                    </div>
                                    <div class="card-content">
                                        <div class="content">
                                            <p class="title is-4">{{$product->name}}</p>
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
            </div>
        </div>
    </div>
@endsection
