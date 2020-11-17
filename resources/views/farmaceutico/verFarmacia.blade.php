@extends('farmaceutico.indexFarmaceutico')
@section('titulo','Farmacias y sucursales')

@section('opcionesFarmaceutico')

    <div class="container">
        <div class="row justify-content-left">
            <div class="col-12 ">
                @if($arrayFarmacias == NULL)
                        <div class="shadow p-3 mb-5 backCard rounded"> 
                            <h2 class="page-section-heading text-uppercase text-secondary mb-0">No posee Farmacias cargadas</h2>
                            <p class="text-center">Si cree que esto es un error, contacte al Administrador </p>
                        </div>    
                @else          
                    @foreach ($arrayFarmacias as $farmacia)
                        <div class="shadow p-3 mb-5 backCard rounded">
                            <div class="row" >
                                <div Class="col-lg-8 col-12" >
                                        <h2 class="page-section-heading text-uppercase text-secondary  m-3">{{ $farmacia->nombre_farmacia }}</h2>
                                         <div class="text m-3 p-3">   
                                            <p>Descripción: {{ $farmacia->descripcion_farmacia }}<p>
                                            <hr>
                                            <p>CUIT: {{ $farmacia->cuit }}</p>
                                            <hr>
                                            @if($farmacia->habilitada == 1)
                                                 <span class="text-left text-success">Estado: habilitada </>   
                                            @else
                                                <p class="text-left text-warning">Estado: Deshabilitada </p> 
                                            @endif
                                         </div>   
                                    </div>
                                    <div Class="col-lg-3 col-12">
                                            <div class="d-flex justify-content-center m-3">
                                                    <figure class="figure">
                                                        <img src="{{ asset($farmacia->img_farmacia) }}" width="200" alt="Imagen Logo">
                                                    </figure>
                                            </div>
                                     </div>
                                    @can('esFarmaceutico')
                                        <div class="col-12">
                                            <div class="d-flex justify-content-center">  
                                                    <div class="p-2">    
                                                        <a href="{{ route('farmacia.edit', [ $farmacia->id_farmacia]) }}"><i class="material-icons" style="font-size: 40px" data-toggle="tooltip" data-placement="left"  title="Editar Farmacia">edit</i></a>
                                                    </div>   
                                                    <div class="p-2"> 
                                                        <a href=""><i class="material-icons" style="font-size: 40px" data-toggle="tooltip" data-placement="left"  title="Eliminar Farmacia">delete</i></a>
                                                    </div>
                                                    <div class="p-2">    
                                                       <!-- <a href="{{ route('farmacia.index') }}"><i class="material-icons" style="font-size: 40px" data-toggle="tooltip" data-placement="left"  title="Volver atrás">arrow_back</i></a> -->
                                                    </div>        
                                            </div>
                                        </div> 
                                     @endcan               
                                </div>
                             </div>    
                    @endforeach    
                @endif
            </div>        
        </div>
    </div>
@endsection        