@extends('welcome')
@section('titulo','Home')

@section('contenido')
     <div class="container">
        <div class="row">
            <div class="col-10 shadow bg-white mx-auto">
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
                                    <div Class="col-lg-4 col-12 mt-4 mx-auto">
                                        <div class="d-flex justify-content-center">
                                            @if( $usuarioFarmaceutico->img_perfil == NULL)
                                                <img class="card-img-top shadow img-thumbnail" src="{{URL::to('/')}}/storage/foto_perfil/logoPerfil.png" alt="Imagen de perfil avatar" width="300" height="300">
                                            @else
                                                <img class="card-img-top shadow img-thumbnail" src="{{ asset($usuarioFarmaceutico->img_perfil) }}" alt="Imagen de perfil avatar" width="300" height="300">
                                            @endif
                                        </div>
                                        <div class="col-12 ">
                                            <div class="d-flex justify-content-center">         
                                                  @yield('subir_foto')
                                                  <!-- Section for upload image form -->                                                  
                                                    
                                            </div>
                                        </div>
                                     </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-center">
                                        <div class="p-2"> 
                                            <a href="{{ route('editarPerfil') }}"><i class="material-icons" style="font-size: 40px" data-toggle="tooltip" data-placement="left"  title="Editar datos">edit</i></a>
                                        </div>   
                                        <div class="p-2"> 
                                            <a href="" title="Eliminar cuenta de usuario" data-toggle="modal" data-target="#deleteModal" data-id_farma=""><i class="material-icons" style="font-size: 40px" data-placement="left">delete</i></a>
                                        </div>
                                        <div class="p-2">
                                            <a href="{{ route('subirFotoPerfil') }}"><i class="material-icons" style="font-size: 40px" data-toggle="tooltip" data-placement="left"  title="Subir foto de perfil">cloud_upload</i></a>
                                        </div>
                                    </div> 
                                </div>    
                            </div>         
                @endcan
            </div>
       </div>         
    </div>
@endsection