<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One" rel="stylesheet">
    <style>
        body {
            font-size: 15px;
            background-color: white;
        }
        .badge {
            font-size: 14px;
        }
        .nowrap {
            white-space: nowrap;
        }
        .wrap {
            word-wrap: break-word;
        }
        .logo {
            font-family: 'Alfa Slab One';
        }
        .img-producto {
            height: 100px;
            /* vertical-align: text-top; */
        }
        .boton-sesion {
            width: 4.3rem;
        }
        input[type="number"] {
            width: 60px;
        }
        .ancho-comandos {
            width: 110px;
        }
    </style>
    <title>SportStore - @yield('title')</title>
</head>
<body class="m-4">
    <div class="container-fluid">
        @if (\Auth::check())
            @if (\Auth::user()->esAdmin())
                <div class="bg-danger fixed-top text-white text-center">Logueado como Administrador</div>
            @endif
        @endif

        <div class="bg-dark text-white rounded d-inline-flex w-100 p-1 pl-3">
            <a class="unlink pt-2 pb-1" href="/">
                <img src="{{ asset('img/logo.png') }}" alt="Sport Store" height="37" >
            </a>
            <a class="unlink pt-3 ml-1 pb-1 d-none d-sm-block" href="/">
                <h3 class="logo">SPORT STORE</h3>
            </a>

            @component('componentes.resumen_carrito', ['carrito' => $carrito])
            @endcomponent

            @if (\Auth::check())
                <a href="{{ route('autenticacion.cerrarsesion') }}"
                    class="btn btn-big btn-secondary boton-sesion text-center d-flex align-items-end flex-wrap justify-content-center"
                    title="Cerrar sesión">
                    <i class="fa fa-sign-out fa-lg"></i>
                    Cerrar
                </a>
            @else
                <a href="{{ route('autenticacion.index') }}"
                   class="btn btn-big btn-info boton-sesion text-center d-flex align-items-end flex-wrap justify-content-center"
                   title="Iniciar sesión">
                    <i class="fa fa-sign-in fa-lg"></i>
                   Iniciar
                </a>
            @endif

        </div>
        @component('componentes.mensaje')
        @endcomponent

        <div class="mb-3"></div>
        @yield('content')
    </div>

    <script type="text/javascript">
        @yield('script');
    </script>
</body>
</html>
