<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        .container {
            height: 100vh;
            font-family:Arial, Helvetica, sans-serif;
        }

        #encabezado h1 {
            color: black;
        }

        #encabezado h3 {
            color: black;
        }

        #encabezado {
            text-align: center;
            height: 10%;
            background-color: #1abc9c !important;
        }

        #foot {
            color: white;
            background-color: #2c3e50;
            font-size: 10px;
        }
        
        #copy {
            text-align: center;
            background-color: #1a252f;
            font-size: 10px;
            width: 100%;
            height: 20px;
            margin-top: 5px;
        }

        .social {
            padding: 2px;
        }

    </style>
</head>

<body>
    <div class="container mt-3">

        <div class="card mb-3 ">
            <div id="encabezado" class="card-header bg-transparent">
                <!-- Masthead Heading-->
                <h3 class="text-center text-white">TU BOTIQUÍN</h3>
                <!-- Masthead Subheading-->
                <h5 class="text-center text-white">Tu farmacia de turno</h5>

            </div>
            <div class="card-body text-success">
                <h5 class="card-title text-cente">@yield('encabezado-email')</h5>
                @yield('contenido-email')
            </div>
            <div id="footcard" class="card-footer bg-transparent">
                <!-- Footer Social Icons-->
                <div id="foot" class="row rounded-bottom">
                    <div class="col-12 text-center">
                        <h5 class="text-uppercase">Buscanos</h5>
                        <a class="btn btn-outline-light social mx-1" href="#!">Facebook</i></a>
                        <a class="btn btn-outline-light social mx-1" href="#!">Twitter</i></a>
                        <a class="btn btn-outline-light social mx-1" href="#!">Instagram</a>
                        <!--  <a class="btn btn-outline-light social mx-1" href="#!"><i
                                class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light social mx-1" href="#!"><i
                                class="fab fa-fw fa-instagram"></i></a> -->
                    </div>
                    <!--Copyright Section-->
                    <div id="copy" class="copyright col-12 text-white rounded-bottom">
                        <p>©TuBotiquín 2020</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
