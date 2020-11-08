@extends('welcome')
@section('titulo','Farmacias y sucursales')

@section('contenido')

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-12">
                   @if($arrayFarmacias == NULL)
                        <div class="shadow p-3 mb-5 bg-white rounded"> 
                            <h2 class="page-section-heading text-uppercase text-secondary mb-0">No posee Farmacias cargadas</h2>
                            <p class="text-center">Si cree que esto es un error, contacte al Administrador </p>
                        </div>    
                    @else
                    
                          
                    @foreach ($arrayFarmacias as $farmacia)
                        <div class="shadow p-3 mb-5 bg-white rounded">
                            <div class="row">
                                <div Class="col-md-8 col-12">
                                        <h2 class="page-section-heading text-uppercase text-secondary  m-3">{{ $farmacia->nombre_farmacia }}</h2>
                                         <div class="text m-3 p-3">   
                                            <p class="text-left">{{ $farmacia->descripcion_farmacia }}<p>
                                            <p>CUIT: {{ $farmacia->cuit }}</p>
                                            @if($farmacia->habilitada == 1)
                                                <p class="text-left">Estado: habilitada </p>   
                                            @else
                                                <p class="text-left">Estado: Deshabilitada </p> 
                                            @endif
                                         </div>   
                                    </div>
                                    <div Class="col-md-4 col-12">
                                            <div class="d-flex justify-content-center m-3">
                                                    <figure class="figure">
                                                        <img src="{{ asset($farmacia->img_farmacia) }}" width="200" alt="Imagen Logo">
                                                    </figure>
                                            </div>
                                     </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-center">  
                                                    <a href="" class="btn btn-primary btn-sm mr-1">Editar</a>
                                                    <a href="" class="btn btn-primary btn-sm mr-1">Eliminar</a>
                                                    <a href="{{ route('farmacia.index') }}" class="btn btn-primary btn-sm mr-1">Volver atrás</a>
                                        </div>
                                    </div>             
                                </div>
                             </div>    
                    @endforeach    
                    @endif
            </div>        
        </div>
    </div>
@endsection        