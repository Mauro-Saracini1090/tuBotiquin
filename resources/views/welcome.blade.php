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

</head>

<body id="page-top">

    <!-- Masthead-->
    <header class="masthead  text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->

            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0  text-dark">TU BOTIQUÍN</h1>

            <!-- Masthead Subheading-->
            <h3 class="masthead-subheading  mb-0 text-dark ">Tu farmacia de turno</h3>
        </div>

    </header>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg  bg-primary text-uppercase shadow" id="mainNav">

        <div class="container">
            <a class="navbar-brand js-scroll-trigger pl-0" id="page-top"
                href="{{ route('home') }}">TuBotiquín</a>
            @auth
                <div class="badge badge-primary text-wrap mx-2 mb-0">
                    {{ Auth::user()->nombre_usuario }}
                    {{ Auth::user()->getRoles->isNotEmpty() ? Auth::user()->getRoles->first()->nombre_rol : "" }}
                </div>
            @endauth
            <button
                class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
                type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto" style="font-size: 1.0rem">

                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                            href="{{ route('farmacias') }}">Farmacias</a>
                    </li>
                    @cannot('esFarmaceutico')
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                href="{{ route('emailcontacto')}}">Contacto</a>
                        </li>
                    @endcannot    

                    @can('esFarmaceutico')
                        <li class="dropdown nav-item mx-0 mx-lg-1">
                            <a class="nav-link dropdown-toggle py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                                aria-expanded="false">Farmaceutico</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('miPerfilFarmacuetico') }}">Mi Perfil</a>
                                <a class="dropdown-item" href="{{ route('panel.farmaceutico') }}">Panel de opciones</a>
                            </div>
                        </li>
                    @endcan


                    @auth
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded " href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                SALIR
                            </a></li>
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
        <div class="container">
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
                        <li> <a href="{{route('home')}}" class="text-white">HOME</a> </li>
                            <li> <a href="{{ route('farmacias') }}" class="text-white">FARMACIAS</a>
                            </li>
                            <li><a href="{{ route('emailcontacto')}}" class="text-white">CONTACTO</a> </li>
                            @auth
                                <li>
                                    <a href="#" class="text-white"
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
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-instagram"></i></a>
                </div>
                <!-- Footer About Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">Acerca</h4>
                    <p class="lead mb-0">
                        Aquí podrás ver las farmacias que se encuentran de turno
                        <hr>
                        <a href="#" class="text-white">PREGUNTAS FRECUENTES</a></li>
                    </p>

                </div>
            </div>
        </div>
    </footer>
    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container">© TuBotiquín 2020</div>
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
    <!-- Contact form JS-->
    <script src="assets/mail/jqBootstrapValidation.js"></script>
    <script src="assets/mail/contact_me.js"></script>
    <!-- Core theme JS-->
    <!-- <script src="js/scripts.js"></script> -->
    @yield('zona_js')
</body>

</html>
