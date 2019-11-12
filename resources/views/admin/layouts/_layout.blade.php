<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials._metas')
    <title>{{ config('app.name', 'Equibra') }} - @yield('title') </title>
    <link href="{{ asset('css/all.css')}}" rel="stylesheet">
    <link href="{{ asset('vendors/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    @stack('stylesheets')
    <link href="{{asset('img/favicon.ico')}}" rel="icon" type="image/png">
</head>

<body>

{{--Page Wrapper--}}
<div id="wrapper">

    {{-- Sidebar --}}
    @include('admin.partials._sidebar')
    {{-- End Sidebar --}}

    {{-- Content Wrapper --}}
    <div id="content-wrapper" class="d-flex flex-column">

        {{--Main content--}}
        <main id="content">

            {{--Navbar--}}
            @include('admin.partials._navbar')
            {{-- End Navbar--}}

            {{--Begin Page Content--}}
            <div class="container-fluid">
                @if (!Auth::user()->change_password)
                    <div class="alert alert-warning mt-2" role="alert">
                        Tu contraseña temporal es insegura, recuerda cambiarla.
                        <a href="{{route('admin.editProfile')}}" class="alert-link">Cambiar contraseña</a>.
                    </div>
                @endif
                {{-- NOTIFY JAVASCRIPT --}}
                {{--                    <div id="alert-notify-success" class="alert-notifier alert alert-success alert-dismissible fade"--}}
                {{--                        role="alert"></div>--}}
                @yield ('content')
            </div>

            {{--End Begin Page Content--}}
        </main>
        {{-- End Main content--}}

        {{--Footer--}}
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Equibra 2019</span>
                </div>
            </div>
        </footer>
        {{--End footer--}}
    </div>
    {{-- End Content Wrapper --}}
</div>
{{--End Page Wrapper--}}

<script src="{{asset('js/all.js')}}"></script>
<script>
    var APP_URL = {!! json_encode(url('/admin/')) !!}
    function shootAlert(type, title, msg) {
        let tmp = ``;
        if (type == "success") {
            tmp = `
                <div class="_alert _alert-positive alert-notifier fade show">
                    <div class="_alert-body">
                    <div class="_alert-icon _icon-positive">
                        <i class="far fa-check-circle"></i>
                    </div>
                    <div class="alert-msj">
                        <p class="_alert-title">${title}</p>
                        <p class="_alert-text">${msg}</p>
                    </div>
                    </div>
                </div>
            `;
        } else if (type == "error") {
            tmp = `
                <div class="_alert _alert-negative alert-notifier fade show">
                    <div class="_alert-body">
                    <div class="_alert-icon _icon-negative">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="alert-msj">
                        <p class="_alert-title">${title}</p>
                        <p class="_alert-text">${msg}.</p>
                    </div>
                    </div>
                </div>
            `;
        }
        $("body").prepend(tmp);
        setTimeout(function () {
            $(".alert-notifier").fadeTo(600, 0).slideUp(600, function () {
                $(this).remove();
            });
        }, 2000);
    }
</script>
@stack('optional_scripts')
</body>

</html>
