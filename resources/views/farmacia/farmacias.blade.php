@extends('welcome')
@section('titulo','Farmacias')

@section('contenido')
    <div class="container">
     <div class="card-body mb-2">
        <!-- Masthead Subheading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Farmacias</h2>
        <p class="lead text-center">Busque su farmacia</p>
        <br>                       
        <form method="POST" action="{{ route('login') }}">
        @csrf
            <div class="form-group">
                <div class="col-md-12">
                    <div class="input-group mb-0 p-0">
                        <input id="busqueda" type="text"
                                class="form-control @error('busqueda') is-invalid @enderror" name="busqueda"
                                placeholder="Escriba el nombre de la farmacia">
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
                        <div class="shadow p-2 mb-4 bg-white rounded">          
                            <img class="card-img-top" src="../public/assets/img/health_1.svg" alt="Card image cap" width="600" height="250">
                                <div class="card-body">
                                    <h4 class="card-title"> {{ $farmacia->nombre_farmacia}}</h4>
                                    <p class="card-text">Breve descripción farmacia</p> 
                                    <hr>
                                    <a href="{{ route ('sucursal.farmaciaSucursal') }}" class="btn btn-primary btn-sm">Ver sucursales</a>
                                </div>
                        </div>
                    </div> 
                 @endif             
            @endforeach
         </div>

         <!-- Pagination for 6 elements -->
         <div class="d-flex d-flex justify-content-center mt-4"> 
                 {{ $arrayFarmacias->links() }}
         </div>
    </div>           
@endsection


                    