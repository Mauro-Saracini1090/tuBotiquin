@extends('farmaceutico.indexFarmaceutico')
@section('titulo','Cargar Sucursal')

@section('opcionesFarmaceutico')
<div class="container">
    @foreach($farmacias as $farmacia)
            @if($farmacia->habilitada == 1)
                    <div class="card shadow p-2 mb-4 backCard rounded col-12 mx-auto">
                        <div class="row">
                            <div class="col-4">
                                <img class="card-img-top" src="{{ asset($farmacia->img_farmacia) }}" alt="Logotipo" width="100" height="150">
                            </div>
                            <div class="col-8 my-auto">
                                <h4 class="card-title"> {{ $farmacia->nombre_farmacia }}</h4>
                                <p class="font-italic">{{ $farmacia->descripcion_farmacia }}</p>
                            </div>
                        </div>
                        <hr>
                        @foreach ($sucursales as $sucursal)
                        @if ($sucursal->getFarmacia->id_farmacia == $farmacia->id_farmacia)
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    
                                        <p>{{ $sucursal->descripcion_sucursal}}</p>
                                        <p>Cufe {{ $sucursal->cufe_sucursal}}</p> 
                                        <p>Email: {{$sucursal->email_sucursal }}</p> 
                                        
                                </div>
                                <div class="col-6 text-right">
                                    <div class="p-2">    
                                        <a href=""><i class="material-icons" style="font-size: 40px" data-toggle="tooltip" data-placement="left"  title="Editar Sucursal">edit</i></a>
                                    </div>   
                                    <div class="p-2"> 
                                        <a href=""><i class="material-icons" style="font-size: 40px" data-toggle="tooltip" data-placement="left"  title="Eliminar Sucursal">delete</i></a>
                                    </div>
                                </div>                                
                            </div>
                            <hr>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <hr>
            @endif
    @endforeach
</div>

@endsection
