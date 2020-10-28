<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>TuBotiquin @yield('titulo')</title>
    <!-- Favicon-->
    @section('iconPestaña') <link rel="icon" type="image/x-icon" href="../public/assets/img/botiquin-medico.svg" /> @show
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/tuBotiquin/public/css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Masthead-->
    <header class="masthead bg-imagen text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <img class="masthead-avatar img-fluid mb-0" style="width: 400px"
                src="/tuBotiquin/public/assets/img/health_1.svg" alt="" />
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0 ">TuBotiquin</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line shadow rounded"></div>
                <div class="divider-custom-icon"><i class="fas fa-briefcase-medical"></i></i></div>
                <div class="divider-custom-line shadow rounded"></div>
            </div>
            <!-- Masthead Subheading-->
            <p class="masthead-subheading font-weight-light mb-0">Farmacia de Turno - Reservar - Solicitar - Medicamentos </p>
            @if(session()->has('estado'))
            <div class="alert alert-danger alert-dismissible fade show focus" role="alert">
                <strong>{{ session()->get('estado') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        </div>
    </header>
    
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">

        <div class="container-fluid">
            <a class="navbar-brand js-scroll-trigger pl-0" id="page-top"
                href="{{ route('home') }}">TuBotiquin</a>
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
                <ul class="navbar-nav ml-auto" style="font-size: 0.80rem">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded "
                            href="#portfolio">Farmacia de Turno</a></li>
                
                    @auth
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded " href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar Sesion
                        </a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none btn btn-success">
                            @csrf
                        </form>
                    @else
                        @if(Route::has('register'))
                            <li class="nav-item mx-0 mx-lg-1"><a
                                    class="nav-link py-3 px-0 px-lg-3 rounded "
                                    href="{{ route('register') }}">Registrarse</a></li>
                        @endif

                        <li class="nav-item mx-0 mx-lg-1"><a
                                class="nav-link py-3 px-0 px-lg-3 rounded "
                                href="{{ route('login') }}">Ingresar</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            @section('contenido')


            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Farmacias de Turno</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-briefcase-medical"></i></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row">
                <!-- Portfolio Item 1-->
                <div class="card col-md-5 col-lg-5 mb-5 mx-auto p-0">
                    <img src="/tuBotiquin/public/assets/img/health_2.svg" class="img-fluid card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Farmacia de Turno 1</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                            <hr>
                            <a href="#" class="btn btn-primary">Mas Informacion</a>
                    </div>
                </div>
                <!-- Portfolio Item 2-->
                <div class="card col-md-5 col-lg-5 mb-5 mx-auto p-0">
                    <img src="/tuBotiquin/public/assets/img/health_2.svg" class="img-fluid card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Farmacia de Turno 2</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                            <hr>
                            <a href="#" class="btn btn-primary">Mas Informacion</a>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-block">
                <!-- Portfolio Section Heading-->
                <h3 class="subtitulo-home text-center text-uppercase text-secondary mb-0">Siguientes Farmacias de Turno
                </h3>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-briefcase-medical"></i></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
            <div class="row">
                <!-- Portfolio Item 3-->
                <div class="card col-md-3 col-lg-3 mb-5 mx-auto p-0 d-none d-md-block">
                    <img src="/tuBotiquin/public/assets/img/health_3.svg" class="img-fluid card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Farmacia Siguiente de Turno 1</h5>
                        <p class="card-text ">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                            <hr>
                            <a href="#" class="btn btn-primary">Mas Informacion</a>
                    </div>
                </div>

                <!-- Portfolio Item 4-->
                <div class="card col-md-3 col-lg-3 mb-5 mx-auto p-0 d-none d-md-block">
                    <img src="/tuBotiquin/public/assets/img/health_3.svg" class="img-fluid card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Farmacia siguiente de Turno 2</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                            <hr>
                            <a href="#" class="btn btn-primary">Mas Informacion</a>
                    </div>
                </div>

                <!-- Portfolio Item 5-->
                <div class="card col-md-3 col-lg-3 mb-5 mx-auto p-0 d-none d-md-block">
                    <img src="/tuBotiquin/public/assets/img/health_3.svg" class="img-fluid card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Farmacia siguiente de Turno 3</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                            <hr>
                            <a href="#" class="btn btn-primary">Mas Informacion</a>
                    </div>
                </div>
            </div>
            @show
        </div>

    </section>
   {{-- <!-- About Section-->
    <!-- About Section-->
    <section class="page-section bg-secondary text-white mb-0" id="about">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white">Sobre Nosotros</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-briefcase-medical"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- About Section Content-->
            <div class="row">
                <div class="col-lg-4 ml-auto">
                    <p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download
                        includes the complete source files including HTML, CSS, and JavaScript as well as optional SASS
                        stylesheets for easy customization.</p>
                </div>
                <div class="col-lg-4 mr-auto">
                    <p class="lead">You can create your own custom avatar for the masthead, change the icon in the
                        dividers, and add your email address to the contact form to make it fully functional!</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section-->
    <section class="page-section" id="contact">
        <div class="container">
            <!-- Contact Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Contactanos</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-briefcase-medical"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Contact Section Form-->
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                    <form id="contactForm" name="sentMessage" novalidate="novalidate">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Nombre</label>
                                <input class="form-control" id="name" type="text" placeholder="Nombre"
                                    required="required" data-validation-required-message="Please enter your name." />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Correo Electronico</label>
                                <input class="form-control" id="email" type="email" placeholder="Correo Electronico"
                                    required="required"
                                    data-validation-required-message="Please enter your email address." />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Numero Telefonico</label>
                                <input class="form-control" id="phone" type="tel" placeholder="Numero Telefonico"
                                    required="required"
                                    data-validation-required-message="Please enter your phone number." />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Mensaje</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Mensaje"
                                    required="required"
                                    data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br />
                        <div id="success"></div>
                        <div class="form-group"><button class="btn btn-primary btn-xl"
                                id="sendMessageButton" type="submit">Enviar</button></div>
                    </form>
                </div>
            </div>
            @show
        </div>
    </section> --}}
    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Ubicacion</h4>
                    <p class="lead mb-0">
                        2215 John Daniel Drive
                        <br />
                        Clark, MO 65243
                    </p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Redes Sociales</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-instagram"></i></i></a>
                </div>
                <!-- Footer About Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">Desarrolladores</h4>
                    <p class="lead mb-0">
                        Freelance is a free to use, MIT licensed Bootstrap theme created by
                        <a href="http://startbootstrap.com">Start Bootstrap</a>
                        .
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white bg-secondary">
        <div class="container"><small>Copyright © TuBotiquin 2020</small></div>
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
    <script src="/tuBotiquin/public/assets/mail/jqBootstrapValidation.js"></script>
    <script src="/tuBotiquin/public/assets/mail/contact_me.js"></script>
    <!-- Core theme JS-->
    {{-- <script src="/tuBotiquin/public/js/scripts.js"></script> --}}
    @yield('zona_js')
</body>

</html>
