@extends('welcome')
@section('titulo','Home')

@section('contenido')
     <div class="container">
        <div class="row">
            <div class="col-10 shadow bg-white rounded mx-auto">
               @can('esFarmaceutico')
                            <div class="row" >
                                <div class="col-12 bg-encabezado mb-3 p-2">
                                    <h2 class="text-center text-white"> MI PERFIL</h2>
                                </div>  
                                <div Class="col-lg-7 col-12">
                                    <div class="text ml-3">  
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Nombre: <span class="font-weight-bold text-secondary"> {{$usuarioFarmaceutico->nombre }}</span></li>
                                            <li class="list-group-item">Apellido: <span class="font-weight-bold text-secondary"> {{$usuarioFarmaceutico->apellido }}</span></li>
                                            <li class="list-group-item">Nombre de usuario: <span class="font-weight-bold text-secondary"> {{$usuarioFarmaceutico->nombre_usuario }}</span></li>
                                            <li class="list-group-item">E-mail: <span class="font-weight-bold text-secondary"> {{$usuarioFarmaceutico->email }}</span></li>
                                            <li class="list-group-item">Cuil: <span class="font-weight-bold text-secondary"> {{$usuarioFarmaceutico->cuit }}</span></li>
                                            <li class="list-group-item">Cuit: <span class="font-weight-bold text-secondary"> {{$usuarioFarmaceutico->cuit }}</span></li>
                                            <li class="list-group-item">Número de matricula: <span class="font-weight-bold text-secondary">{{$usuarioFarmaceutico->numero_matricula }} </span></li>
                                            <li class="list-group-item"><span class="font-weight-bold text-secondary"> </span></li>
                                        </ul>    
                                    </div>   
                                    </div>
                                    <div Class="col-lg-4 col-12  border">
                                        <div class="d-flex justify-content-center m-3">
                                            <figure class="figure">
                                                <img src="" width="200" alt="Imagen del perfil aca">
                                            </figure>
                                        </div>
                                        <div class="">
                                                 <a href=""><i class="material-icons" style="font-size: 40px" data-toggle="tooltip" data-placement="left"  title="Editar Farmacia">account_box</i>Cargar foto</a>
                                        </div>
                                     </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-center">
                                        <div class="p-2">    
                                            <a href=""><i class="material-icons" style="font-size: 40px" data-toggle="tooltip" data-placement="left"  title="Editar Farmacia">edit</i></a>
                                        </div>   
                                        <div class="p-2"> 
                                            <a href="" title="Eliminar Farmacia" data-toggle="modal" data-target="#deleteModal" data-id_farma=""><i class="material-icons" style="font-size: 40px" data-placement="left"  ">delete</i></a>
                                        </div>
                                    </div> 
                                </div>    
                            </div>         
                @endcan
            </div>
       </div>         
    </div>
@endsection