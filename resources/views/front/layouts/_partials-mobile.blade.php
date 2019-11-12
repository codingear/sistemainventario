    <div id="Sidenav" class="navbar-mobile" data-toggle="false">
        <div class="navbar-mobile__header">
            <span>Menú</span>
            <a class="navbar-mobile__closebtn" id="m-close-nav"><i class="fas fa-times"></i></a>
        </div>
        <div class="navbar-mobile__body">
            <a class="navbar-mobile__link" href="#">
                <span class="navbar-mobile__link-icon">
                    <i class="fas fa-home"></i>
                </span>
                <span class="navbar-mobile__link-text">
                    Inicio
                </span>
            </a>
            <div>
                <div class="navbar-mobile__link-multimenu">
                    <a class="navbar-mobile__link" href="#">
                        <span class="navbar-mobile__link-icon">
                            <i class="fas fa-store"></i>
                        </span>
                        <span class="navbar-mobile__link-text">
                            Tienda
                        </span>
                    </a>
                    <button class="navbar-mobile__btn-submenu" id="shop-toggle">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <div class="navbar-mobile__menu-collapse" id="secondary-menu">
                    <ul>
                        <li><a class="navbar-mobile__menu-collapse-item" href="">categoria 1</a></li>
                        <li><a class="navbar-mobile__menu-collapse-item" href="">categoria 2</a></li>
                        <li><a class="navbar-mobile__menu-collapse-item" href="">categoria 3</a></li>
                        <li><a class="navbar-mobile__menu-collapse-item" href="">categoria 4</a></li>
                        <li><a class="navbar-mobile__menu-collapse-item" href="">categoria 5</a></li>
                        <li><a class="navbar-mobile__menu-collapse-item" href="">categoria 4</a></li>
                        <li><a class="navbar-mobile__menu-collapse-item" href="">categoria 5</a></li>
                    </ul>
                </div>
            </div>
            <a class="navbar-mobile__link" href="#">
                <span class="navbar-mobile__link-icon">
                    <i class="fas fa-store-alt"></i>
                </span>
                <span class="navbar-mobile__link-text">
                    Franquicias
                </span>
            </a>
            <a class="navbar-mobile__link" href="#">
                <span class="navbar-mobile__link-icon">
                    <i class="fas fa-phone"></i>
                </span>
                <span class="navbar-mobile__link-text">
                    Contacto
                </span>
            </a>
            <a class="navbar-mobile__link" href="#">
                <span class="navbar-mobile__link-icon">
                    <i class="fas fa-info-circle"></i>
                </span>
                <span class="navbar-mobile__link-text">
                    Nosotros
                </span>

            </a>
        </div>
    </div>

    <div class="cart-mobile" id="Cartnav" data-toggle="false">
        <div class="cart-mobile__header">
            <a class="cart-mobile__header-closebtn" id="m-close-cart"><i class="fas fa-times"></i></a>
            <span>Carrito</span>
        </div>
        <div class="cart-mobile__body">
            <div class="cart-mobile__item">
                <article class="media">
                    <figure class="media-left">
                        <p class="image is-64x64">
                            <img class="is-rounded" src="https://bulma.io/images/placeholders/64x64.png">
                        </p>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong><a class="cart-mobile__link-product" href="">Valvula Solenoide </a></strong>
                                <span class="cart-mobile__product-detail">Cantidad: x 1</span>
                                <span class="cart-mobile__product-detail">Precio Total: <strong class="is-primary">$500</strong></span>
                            </p>
                        </div>
                    </div>
                    <div class="media-right">
                        <button class="button is-danger is-small">
                            <span class="icon is-small">
                                {{-- <i class="fas fa-times"></i> --}}
                                <i class="fas fa-minus"></i>
                            </span>
                        </button>
                        {{-- <button class="delete is-danger"></button> --}}
                    </div>
                </article>
            </div>
            <div class="cart-mobile__item">
                <article class="media">
                    <figure class="media-left">
                        <p class="image is-64x64">
                            <img class="is-rounded" src="https://bulma.io/images/placeholders/64x64.png">
                        </p>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong><a class="cart-mobile__link-product" href="">Valvula Solenoide </a></strong>
                                <span class="cart-mobile__product-detail">Cantidad: x 1</span>
                                <span class="cart-mobile__product-detail">Precio Total: <strong class="is-primary">$500</strong></span>
                            </p>
                        </div>
                    </div>
                    <div class="media-right">
                        <button class="button is-danger is-small">
                            <span class="icon is-small">
                                {{-- <i class="fas fa-times"></i> --}}
                                <i class="fas fa-minus"></i>
                            </span>
                        </button>
                        {{-- <button class="delete is-danger"></button> --}}
                    </div>
                </article>
            </div>
            <div class="cart-mobile__item">
                <article class="media">
                    <figure class="media-left">
                        <p class="image is-64x64">
                            <img class="is-rounded" src="https://bulma.io/images/placeholders/64x64.png">
                        </p>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong><a class="cart-mobile__link-product" href="">Ultimo </a></strong>
                                <span class="cart-mobile__product-detail">Cantidad: x 1</span>
                                <span class="cart-mobile__product-detail">Precio Total: <strong class="is-primary">$500</strong></span>
                            </p>
                        </div>
                    </div>
                    <div class="media-right">
                        <button class="button is-danger is-small">
                            <span class="icon is-small">
                                {{-- <i class="fas fa-times"></i> --}}
                                <i class="fas fa-minus"></i>
                            </span>
                        </button>
                        {{-- <button class="delete is-danger"></button> --}}
                    </div>
                </article>
            </div>
            
        </div>{{-- BODY CARD --}}
        <div class="cart-mobile__footer">
            <div class="cart-mobile__totals">
                <table class="cart-mobile__totals-table">
                    <tbody>
                        <tr>
                            <td class="cart-mobile__totals-table-title">Sub-Total:</td>
                            <td class="cart-mobile__totals-table-text">$10,000</td>
                        </tr>
                        <tr>
                            <td class="cart-mobile__totals-table-title">Envio:</td>
                            <td class="cart-mobile__totals-table-text">Gratis</td>
                        </tr>
                        <tr>
                            <td class="cart-mobile__totals-table-title">Total:</td>
                            <td class="cart-mobile__totals-table-text">$10,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="cart-mobile__actions">
                <div class="buttons cart-mobile__actions-buttons">
                    <button class="button">Ver Carrito</button>
                    <button class="button is-primary">Pagar</button>
                </div>
            </div>
        </div>
    </div>
