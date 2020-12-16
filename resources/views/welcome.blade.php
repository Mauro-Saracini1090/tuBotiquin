<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TuBotiquin @yield('titulo')</title>
    <!-- Font Awesome icons (free version)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/tuBotiquin/public/css/styles.css" rel="stylesheet">
    <!--<link href="../public/css/styles.css" rel="stylesheet" /-->

    {{-- Leaflet - map osm --}}
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />

    <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">



</head>

<body id="page-top">

    <!-- Masthead-->
    <header class="masthead  text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->

            <!-- Masthead Heading-->
            <h1 class="text-uppercase mb-0 texto-titulo2 text-dark">TU BOTIQUÍN</h1>
            <img src="{{url('/')}}/assets\img\logo2png.png" class="my-auto" alt="logo" width="120">
            <!-- Masthead Subheading
            <h2 class="masthead-subheading mt-3 mb-0 text-dark  texto-titulo">Tu farmacia de turno</h2>-->
        </div>

    </header>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg  bg-primary text-uppercase shadow" id="mainNav">

        <div class="container">
            <a class="navbar-brand js-scroll-trigger pl-0" id="page-top"
                href="{{ route('home') }}">TuBotiquín</a>
            <button
                class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
                type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            @if (count(Cart::getContent()))
               <a class="navbar-brand js-scroll-trigger pl-0" href="{{route('cart.checkout')}}"><span class="badge badge-danger">{{count(Cart::getContent())}}</span><i class="material-icons mx-0 pr-2 align-middle">shopping_cart</i></a>
            @endif
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto" style="font-size: 1.0rem">

                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                            href="{{ route('farmacias') }}">Farmacias</a>
                    </li>
                    @cannot('esFarmaceutico')
                        <li class="nav-item mx-0 mx-lg-1"><a
                                class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                href="{{ route('emailcontacto') }}">Contacto</a>
                        </li>
                    @endcannot

                    @auth
                        <li class="nav-item my-auto mx-0 mx-lg-1">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle rounded js-scroll-trigger" data-toggle="dropdown"
                                    href="#dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->email }}
                                    <img class="shadow rounded-circle"
                                        src="{{ url('/') . Auth::user()->img_perfil }}"
                                        alt="Imagen de perfil avatar" width="38px" height="38px">
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg-right">
                                    <!-- MENU FARMACEUTICO -->
                                    @can('esFarmaceutico')
                                        <a class="dropdown-item"
                                            href="{{ route('miPerfilFarmacuetico') }}"><i
                                                class="material-icons px-2 align-middle">account_box</i><span
                                                class="mb-4">Mi Perfil</span></a>
                                        <a class="dropdown-item"
                                            href="{{ route('panel.farmaceutico') }}"><i
                                                class="material-icons px-2 align-middle">settings</i>Farmacuetico</a>
                                    @endcan
                                    <!-- MENU REGISTRADO -->
                                    @can('esRegistrado')
                                        <a class="dropdown-item"
                                            href="{{ route('miPerfilFarmacuetico') }}"><i
                                                class="material-icons px-2 align-middle">account_box</i><span
                                                class="mb-4">Mi Perfil</span></a>
                                        <a class="dropdown-item" href="{{route('listado.reservas.registrado')}}">
                                        <i class="material-icons px-2 align-middle">shopping_cart</i>
                                        <span class="mb-4">Mis Reservas</span>
                                        </a>
                                    @endcan
                                    <!-- FIN MENUS DROPDOWN -->
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="material-icons px-2 align-middle">exit_to_app</i>SALIR</a>
                                </div>

                            </div>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none btn btn-success">
                            @csrf
                        </form>
                    @else
                        @if(Route::has('register'))
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded "
                                    href="{{ route('register') }}">Registrarse</a></li>
                        @endif

                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded "
                                href="{{ route('login') }}">Ingresar</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="portfolio">
        <!-- container principal -->
        <div class="container-fluid">
            <!-- Sector que se reemplaza -->
            @yield('contenido')
        </div>
    </section>

    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container ">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Principal</h4>

                    <p class="lead mb-0">
                        <ul class="list-unstyled">
                            <li> <a href="{{ route('home') }}" class="text-white">HOME</a> </li>
                            <li> <a href="{{ route('farmacias') }}" class="text-white">FARMACIAS</a>
                            </li>
                            <li><a href="{{ route('emailcontacto') }}" class="text-white">CONTACTO</a>
                            </li>
                            @auth
                                <li>
                                    <a href="#salir" class="text-white"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        SALIR
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none btn btn-success">
                                    @csrf
                                </form>
                            @else
                                @if(Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}"
                                            class="text-white">REGISTRARSE</a>
                                    </li>
                                @endif

                                <li>
                                    <a href="{{ route('login') }}" class="text-white">INGRESAR</a>
                                </li>
                            @endif
                        </ul>
                    </p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Buscanos</h4>
                    <a target="_blank" class="btn btn-outline-light btn-social mx-1" title="Link a red social Facebook"
                        href="https://www.facebook.com"><i class="fab fa-fw fa-facebook-f"></i></a>
                    <a target="_blank" class="btn btn-outline-light btn-social mx-1" title="Link a red social Twitter"
                        href="https://www.twitter.com"><i class="fab fa-fw fa-twitter"></i></a>
                    <a target="_blank" class="btn btn-outline-light btn-social mx-1" title="Link a red social Instagram"
                        href="https://www.instagram.com"><i class="fab fa-fw fa-instagram"></i></a>
                </div>
                <!-- Footer About Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">Acerca</h4>
                    <p class="lead mb-0">
                        Aquí podrás ver las farmacias que se encuentran de turno
                        <hr>
                        <a href="{{route('preguntasFrecuentes')}}" class="text-white"><strong>PREGUNTAS FRECUENTES</strong></a></li>
                    </p>

                </div>
            </div>
        </div>
    </footer>
    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container">© TuBotiquín <?php echo date('Y') ?></div>
    </div>
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
    <div class="scroll-to-top d-lg-none position-fixed">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i
                class="fa fa-chevron-up"></i></a>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
    <!-- Core theme JS-->
    <!-- <script src="js/scripts.js"></script> -->
    @yield('zona_js')
</body>

</html>
