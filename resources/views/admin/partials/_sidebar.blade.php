<ul class="navbar-nav bg-main sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <img class="img-sidebar" src="{{asset('img/EquibraIsotipo.svg')}}" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Equibra</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-home"></i>
            <span>Inicio</span>
        </a>
        <a class="nav-link" href="{{route('store')}}" target="_blank">
            <i class="fas fa-store"></i>
            <span>Ir a Tienda</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Inventario
    </div>


    <!-- Nav Item - Almacen-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAlmacen"
           aria-expanded="true" aria-controls="collapseAlmacen">
            <i class="fas fa-boxes"></i>
            <span>Almacen</span>
        </a>
        <div id="collapseAlmacen" class="collapse" aria-labelledby="headingAlmacen" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('categorias.index')}}">Categorías</a>
                <a class="collapse-item" href="{{route('productos.index')}}">Productos</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('proveedores.index')}}">
            <i class="fas fa-handshake"></i>
            <span>Proveedores</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-user-tie"></i>
            <span>Clientes</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-store"></i>
            <span>Ventas Mostrador</span></a>
    </li>

    <!-- Nav Item -Reportes -->
    @can('administradores.index')
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-chart-pie"></i>
                <span>Reportes Ventas</span></a>
        </li>
    @endcan
<!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Multimedia
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{route('imagenes.index')}}">
            <i class="fas fa-images"></i>
            <span>Imágenes</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Heading -->
    <div class="sidebar-heading">
        E-Commerce
    </div>

    <!-- Nav Item - Envíos -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-shopping-basket"></i>
            <span>Pedidos</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-shipping-fast"></i>
            <span>Envíos</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-shopping-bag"></i>
            <span>Ventas Online</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-ticket-alt"></i>
            <span>Tickets</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">
    @can('administradores.index')
    <!-- Heading Administración -->
        <div class="sidebar-heading">
            Ajustes Sistema
        </div>
        <!-- Nav Item - Usuarios -->
        <li class="nav-item {{ request()->is('admin/administradores','admin/administradores/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('administradores.index')}}">
                <i class="fas fa-user-shield"></i>
                <span>Administradores</span></a>
        </li>
    @endcan
    {{--    <!-- Divider -->--}}
    {{--    <hr class="sidebar-divider d-none d-md-block">--}}

    {{--    <!-- Sidebar Toggler (Sidebar) -->--}}
    {{--    <div class="text-center d-none d-md-inline">--}}
    {{--        <button class="rounded-circle border-0" id="sidebarToggle"></button>--}}
    {{--    </div>--}}

</ul>
