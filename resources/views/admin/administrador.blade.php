<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Panel Administrador @yield('titulo')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    {{-- <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json"> --}}
    <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">

    {{-- fullcalendar --}}
    <link href='fullcalendar/main.css' rel='stylesheet' />
    <script src='fullcalendar/main.js'></script>
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>



    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .btn-panel{
          color: white;
          background-color:#1abc9c;
      }
      .btn-panel:hover{
          color: black;
      }
      #navHeader{
          background-color: #1abc9c;
      }
      #admlogout{
          color: white;
      }
      #admfooter{
        color: white;
        background-color: #2c3e50;
      }
      .fc-today-button{
          background-color: #1abc9c !important;
          border-color: #1abc9c !important;
      }
      .fc-prev-button, .fc-next-button{
          background-color: #1abc9c !important;
          border-color: #1abc9c !important;
      }
      #sidebarMenu{
          height: 108vh;
      }
      

    </style>
    <!-- Custom styles for this template -->
    {{-- <link href="dashboard.css" rel="stylesheet"> --}}
</head>

<body>
    <nav id="navHeader" class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow px-3">
       
        <a class="navbar-brand col-4 col-md-3 col-lg-2 mr-0 px-3" href="#">TuBotiquin</a>
        <button class="navbar-toggler col-4 d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth

                    <div class="badge badge-dark text-wrap mx-2 mb-0">
                        {{ Auth::user()->nombre_usuario }}
                        {{ Auth::user()->getRoles->isNotEmpty() ? Auth::user()->getRoles->first()->nombre_rol : "" }}
                    </div>
                @endauth
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a id="admlogout" class="nav-link btn btn-dark mb-1" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar Sesion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                    class="d-none btn btn-success">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row" style="height: 100vh">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="sidebar-sticky pt-3">
                  
                    @auth
                        @can('esAdmin')
                        <ul class="nav flex-column py-2">
                                <li class="nav-item my-1">
                                    <a class="nav-link btn-panel"
                                        href="{{ route('homeAdministrador') }}">
                                        <span></span> Home
                                    </a>
                                </li>
                                {{-- <li class="nav-item my-1">
                                    <a href="{{ route('permisos.index') }}" class="btn-panel nav-link">Permisos</a>
                                </li> --}}
                                <li class="nav-item my-1">
                                    <a href="{{ route('roles.index') }}"
                                        class="nav-link  btn-panel">Roles</a>
                                </li>
                                <li class="nav-item my-1">
                                    <a href="{{ route('usuario.index') }}"
                                        class="nav-link  btn-panel">Usuarios</a>
                                </li>
                                <li class="nav-item my-1">
                                    <a href="{{ route('localidad.index') }}"
                                        class="nav-link btn-panel">Localidades</a>
                                </li>
                                <li class="nav-item my-1">
                                    <a href="{{ route('turno.index') }}"
                                        class="nav-link btn-panel">Asignar Turno</a>
                                </li>
                                <li class="nav-item my-1">
                                    <a href="{{ route('obrasocial.index') }}"
                                        class="nav-link btn-panel">Agregar Obra Social</a>
                                </li>
                                <li class="nav-item my-1">
                                    <a href="{{ route('farmacia.index') }}"
                                        class="nav-link btn-panel">Ver Farmacias</a>
                                </li>
                                <li class="nav-item my-1">
                                    <a href="{{ route('sucursal.index') }}"
                                        class="nav-link btn-panel">Sucursales</a>
                                </li>
                                <li class="nav-item my-1">
                                    <a href="{{ route('tipoMedicamentos.index') }}"
                                        class="nav-link btn-panel">Tipos de Medicamentos</a>
                                </li>
                                <li class="nav-item my-1">
                                    <a href="{{ route('marcaMedicamentos.index') }}"
                                        class="nav-link btn-panel">Marcas de Medicamento</a>
                                </li>
                                <li class="nav-item my-1">
                                    <a href="{{ route('medicamentos.index') }}"
                                        class="nav-link btn-panel">Medicamentos</a>
                                </li>
                        @endcan
                    @endauth
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                @section('datos')
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
                    <h1 class="h2">Home Administrador</h1>

                </div>
                <div class="container bg-light shadow-lg p-3 my-3  bg-white rounded">
                   
                    
                </div>
                @show
            </main>




            <footer id="admfooter" class="footer mt-auto py-3 col-md-12">
                <div class="container-fluid">
                    <span class="text-muted">TuBotiquin - 2020</span>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <script>
        $(document).ready(function(e){
            $('.btn-panel').on('mouseenter',function(e){
                x = e.pageX - $(this).offset().left;
                y = e.pageY - $(this).offset().top;
                $(this).find('span').css({top:y, left:x})
            })
        })
        
    </script>
    @yield('zona_js')
</body>

</html>
