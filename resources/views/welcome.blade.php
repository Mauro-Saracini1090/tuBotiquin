
 <!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <!-- CSRF Token -->
         <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TuBotiquin @yield('titulo')</title>
        @section('iconPestaña') <link rel="icon" type="image/x-icon" href="../public/assets/img/botiquin-medico.svg" /> @show
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <!--<link href="app/public/css/styles.css" rel="stylesheet" />-->
         <link href="../public/css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
       
        <!-- Masthead-->
        <header class="masthead  text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image-->
                
                <!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase mb-0 text-primary">TU BOTIQUÍN</h1>
               
                <!-- Masthead Subheading-->
                <h3 class="masthead-subheading  mb-0 text-primary">Tu farmacia de turno</h3>
            </div>
            <!-- para determinar el estado de la sesion -->
            @if(session()->has('estado'))
            <div class="alert alert-danger alert-dismissible fade show focus" role="alert">
                <strong>{{ session()->get('estado') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
     </header>   

    <!-- Navigation-->
     <nav class="navbar navbar-expand-lg  bg-primary text-uppercase shadow" id="mainNav">

        <div class="container">
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
                <ul class="navbar-nav ml-auto" style="font-size: 1.0rem">

                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('farmacias') }}">Farmacias</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="">Contacto</a></li>
                
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


      
        <div class="container">
            @section('contenido')
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">De turno hoy</h2>
            <p class="lead text-center">Farmacias que se encuentran de turno el día de hoy</p>
            <div class="row">
                <div class="col-md-6"> 
                    <div class="shadow p-3 mb-5 bg-white rounded"> 
                        <div class="col-md-12 mb-3">
                            <img class="card-img-top" src="../public/assets/img/health_1.svg" alt="Card image cap" width="600" height="250">
                            <div class="card-body mb-2">
                                <h4 class="card-title">Farmacia&nbsp;</h4>
                                <p class="card-text">Breve descripción farmacia de turno hoy<br>Horarios y dirección</p> 
                                <hr>
                                <a href="#" class="btn btn-primary btn-sm">Mas información</a>
                            
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="col-md-6">
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <div class="col-md-12 mb-3">
                             <img class="card-img-top" src="../public/assets/img/health_2.svg" alt="Card image cap" width="600" height="250">
                            <div class="card-body mb-2">
                                <h4 class="card-title">Farmacia&nbsp;</h4>
                                <p class="card-text">Breve descripción farmacia de turno hoy<br>Horarios y dirección</p> 
                                <hr>
                                <a href="#" class="btn btn-primary btn-sm">Mas información</a>
                            
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>  

        <hr>
        <div class="container">
           
                  <div class="row">
                    <div class="col-md-12 mt-3">
                      <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Próximas de turno</h2>
                      <p class="lead text-center">Farmacias que se encontrarán de turnos los próximos días  <button type="button" class="btn btn-link">[ Ver más ]</button></p>
                     
                    </div>
                  </div>
                </div>
              
              <div class="py-2 pb-5">
                <div class="container">
                  <div class="row">
                    <div class="col-md-4">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <img class="card-img-top" src="../public/assets/img/health_3.svg" alt="Card image cap">
                                <div class="card-body">
                                <h4 class="card-title">Farmacia de turno siguiente 1</h4>
                                <p class="card-text">Breve descripción farmacia siguiente 1</p> 
                                <hr>
                                <a href="#" class="btn btn-primary btn-sm">Mas Información</a>
                                </div>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <img class="card-img-top" src="../public/assets/img/health_1.svg" alt="Card image cap">
                                <div class="card-body">
                                <h4 class="card-title">Farmacia de turno siguiente 2</h4>
                                <p class="card-text">Breve descripción farmacia siguiente 2</p> 
                                <hr>
                                <a href="#" class="btn btn-primary btn-sm">Mas Información</a>
                                </div>
                            
                        </div>   
                    </div>
                    <div class="col-md-4">
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <img class="card-img-top" src="../public/assets/img/health_.svg" alt="Card image cap" style="">
                                <div class="card-body">
                                <h4 class="card-title">Farmacia de turno siguiente 3</h4>
                                <p class="card-text">Breve descripción farmacia siguiente 3</p>
                                <hr>
                                <a href="#" class="btn btn-primary btn-sm">Mas Información</a>
                                </div>
                            
                        </div>    
                    </div>
                  </div>
                  <hr>
                </div>
             </div>
            
            </section>
        </div>
            @show
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
                                <li> <a href="#" class="text-white">HOME</a> </li>
                                <li> <a href="#" class="text-white">FARMACIAS</a> </li>
                                <li><a href="#" class="text-white">CONTACTO</a> </li>
                                <li><a href="#" class="text-white">REGISTRARSE</a></li>
                                <li><a href="#" class="text-white">INGRESAR</a></li>
                            </ul>
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Buscanos</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-instagram"></i></a>
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
            <div class="container">TuBotiquín 2020</div>
        </div>
        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
        <div class="scroll-to-top d-lg-none position-fixed">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
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
