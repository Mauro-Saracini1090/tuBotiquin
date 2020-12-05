@extends('welcome')
@section('titulo','Farmacias')

@section('contenido')
    <div class="container">

        @if( !(count($arrayMedicamentos)) < 1 )
            <div class="card-body mb-2">
                <!-- Masthead Subheading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Farmacia</h2>
                <p class="lead text-center my-3">Listado de Medicamentos en la Farmacia: {{$farmacia->nombre_farmacia}}</p>
            </div>


            <div class="container">
            <div class="row">
                @foreach ($arrayMedicamentos as $medicamentos)
                @if($medicamentos->pivot->cantidadTotal > 0)
                        <div class="col-lg-4 col-12 mt-4">
                            <div class="shadow bg-white">
                            <div class="col-12 bg-encabezado mb-3 p-3">
                                </div>
                                <div class="d-flex d-flex justify-content-center"> 
                                    <div class="col-6">           
                                    <img class="card-img-top shadow" src="{{ asset($medicamentos->img_medicamento) }}" alt="Logotipo {{$medicamentos->nombre_medicamento}}" width="110" height="110">
                                    </div>
                                </div>       
                                    <div class="card-body text-center">
                                        <h4 class="card-title"> <?php echo strtoupper($medicamentos->nombre_medicamento) ?></h4>
                                        <p class="font-italic"><?php echo $medicamentos->informacion ?></p> 
                                        <p class="font-italic"><?php echo $medicamentos->getTipo->nombre_tipo ?></p> 
                                        <p class="font-italic"><?php echo $medicamentos->getMarca->nombre_marca ?></p> 
                                        <hr>
                                        <p class="font-italic"><?php echo $medicamentos->pivot->cantidadTotal ?></p> 
                                    </div>
                            </div>
                        </div>
                        @endif
                @endforeach
            </div>
        @else 
             <div class="row">
                <div class="col-12 text-center">
                        <div class="p-3 mb-2 bg-warning rounded shadow text-dark ">
                            <h6 class="font-weight-bold text-center mb-2">Atención. Ocurrio un error en la búsqueda, intentelo nuevamente mas tarde</h6>
                            <br>
                            <p>Disculpe las Molestias. <strong>Equipo tuBotiquín</strong></p>
                        </div>
                    </div>
                </div>
        @endif

    </div>           
@endsection