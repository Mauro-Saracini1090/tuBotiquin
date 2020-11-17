<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
            background: url("../../assets/img/encabezado-Tubotiquin2.jpeg") no-repeat center center;
            background-size: cover;
            border-radius: 1em;
        }

        #foot {
            color: white;
            background-color: #2c3e50;
            font-size: 10px;
            padding: 0px;
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
    <div class="container ">
        <header id="encabezado" class="col-12 shadow">
            <div class="encabezado" class="col-12 shadow">
                <!-- Masthead Avatar Image-->

                <!-- Masthead Heading-->
                <h3 class="">TU BOTIQUÍN</h1>

                    <!-- Masthead Subheading-->
                    <h5 class="">Tu farmacia de turno
                </h3>
            </div>
        </header>

        <div>
            <div class="card col-8 mx-auto">
                <div class="card-body">
                    @section('contenidoMsg')

                    @endsection
                </div>
            </div>
        </div>



        <!-- Footer Social Icons-->
        <div id="foot" class="row">
            <div class="col-12 text-center">
                <h5 class="text-uppercase">Buscanos</h5>
                <a class="btn btn-outline-light social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                <a class="btn btn-outline-light social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                <a class="btn btn-outline-light social mx-1" href="#!"><i class="fab fa-fw fa-instagram"></i></a>
            </div>
            <!-- Copyright Section-->
        <div id="copy" class="copyright col-12 text-white">
            <p>TuBotiquín 2020</p>
        </div>
        </div>
    </div>
</body>

</html>
