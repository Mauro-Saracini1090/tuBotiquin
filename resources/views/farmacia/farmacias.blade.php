@extends('welcome')
@section('titulo','Farmacias')

@section('contenido')
    <div class="container">
     <div class="card-body mb-2">
        <!-- Masthead Subheading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Farmacias y Sucursales</h2>
        <p class="lead text-center">Busque su farmacia</p>
        <br>                       
        <form method="POST" action="{{ route('login') }}">
        @csrf
            <div class="form-group row">
                <div class="col-md-12">
                    <div class="input-group mb-0 p-0">
                        <input id="busqueda" type="text"
                                class="form-control @error('busqueda') is-invalid @enderror" name="busqueda"
                                placeholder="Escriba el nombre de la farmacia o sucursal">
                        <div class="input-group-append"><button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button></div>
                        
                        @error('busqueda')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </form>

    </div>
    <div class="container">
        <div class="row">
            @foreach ($arrayFarmacias as  $farmacia)
                @if ($farmacia->habilitada == 1)
                    <div class="col-md-4">
                        <div class="shadow p-3 mb-4 bg-white rounded">          
                            <img class="card-img-top" src="../public/assets/img/health_1.svg" alt="Card image cap" width="600" height="250">
                                <div class="card-body mb-1">
                                    <h4 class="card-title"> {{ $farmacia->nombre_farmacia}}</h4>
                                    <p class="card-text">Breve descripción farmacia de turno hoy<br>Horarios y dirección</p> 
                                    <hr>
                                    <a href="#" class="btn btn-primary btn-sm">Mas información</a>
                                </div>
                        </div>
                    </div> 
                 @endif             
            @endforeach
         </div>
         <!-- Pagiantion for 6 elements -->
         {{ $arrayFarmacias->links() }}
    </div>           
@endsection


                    