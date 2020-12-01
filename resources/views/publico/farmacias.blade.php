@extends('welcome')
@section('titulo','Farmacias')

@section('contenido')
    <div class="container">

        @if( !(count($arrayFarmacias)) < 1 )
            <div class="card-body mb-2">
                <!-- Masthead Subheading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Farmacias</h2>
                <p class="lead text-center my-3">Listado de las farmacias disponibles en la plataforma</p>
            
                <form method="POST" action="{{ route('buscarFarmaciaSucursal')}}">
                    @csrf           
                        <div class="form-group">
                            <div class="form-group">
                                <div class="d-flex d-flex justify-content-center"> 
                                    <select id="id_farmacia" class="form-control"  placeholder="Busque su farmacia aqui" name="id_farmacia"> 
                                            @foreach($arrayFarmacias as $farmacia)
                                                <option value="{{ $farmacia->id_farmacia }}">{{ $farmacia->nombre_farmacia }}</option> 
                                            @endforeach   
                                    </select> 
                                    <button type="submit" class="btn btn-primary mx-2">
                                        {{ __('Buscar') }}
                                    </button> 
                                </div>
                            </div>         
                        </div> 
                    </div>           
                </form>
            </div>


            <div class="container">
            <div class="row">
                @foreach ($arrayFarmaciasPaginate as $farmaciaPaginate)
                    @if ($farmaciaPaginate->habilitada == 1)
                        <div class="col-lg-4 col-12 mt-4">
                            <div class="shadow bg-white">
                            <div class="col-12 bg-encabezado mb-3 p-3">
                                </div>
                                <div class="d-flex d-flex justify-content-center"> 
                                    <div class="col-6">           
                                        <img class="card-img-top shadow" src="{{ asset($farmaciaPaginate->img_farmacia) }}" alt="Logotipo" width="110" height="110">
                                    </div>
                                </div>       
                                    <div class="card-body text-center">
                                        <h4 class="card-title"> <?php echo strtoupper($farmaciaPaginate->nombre_farmacia) ?></h4>
                                        <p class="font-italic"><?php echo $farmaciaPaginate->descripcion_farmacia ?></p> 
                                        <hr>
                                        <form method="POST" action="{{ route('farmaciaSucursal')}}">
                                        @csrf  
                                        <input type="hidden" name="id_farmacia" value= {{ $farmaciaPaginate->id_farmacia }}>
                                        <button type="submit" class="btn btn-link mx-2">
                                                {{ __('Ver Sucursales') }}
                                        </button>    
                                        </form>
                                        @can('esRegistrado')
                                        <div class="p-2">
                                            <a href="{{ route('listado.medicamentos',[$farmaciaPaginate->id_farmacia]) }}"><i class="material-icons" style="font-size: 40px" data-toggle="tooltip" data-placement="left"  title="Listado Medicamentos de {{$farmaciaPaginate->nombre_farmacia}}">event_note</i></a> 
                                        </div>  
                                        @endcan
                                    </div>
                            </div>
                        </div> 
                    @endif             
                @endforeach
            </div>

            <!-- Pagination for 6 elements -->
            <div class="d-flex d-flex justify-content-center mt-4"> 
                    {{ $arrayFarmaciasPaginate->links() }}
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


                    