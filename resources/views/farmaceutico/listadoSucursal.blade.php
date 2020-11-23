@extends('farmaceutico.indexFarmaceutico')
@section('titulo','Cargar Sucursal')

@section('opcionesFarmaceutico')
<div class="container">
    @foreach($farmacias as $farmacia)
            @if($farmacia->habilitada == 1)
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <div class="row">
                            <div class="col-8">
                               <h2 class="text-secondary  m-3"> {{ $farmacia->nombre_farmacia }}</h2>
                                <p class="font-italic m-3"> <?php echo $farmacia->descripcion_farmacia ?> </p>
                            </div>
                            <div class="col-4">
                                <img class="card-img-top" src="{{ asset($farmacia->img_farmacia) }}" alt="Logotipo" width="100" height="150">
                            </div>
                        </div>
                        <hr>
                        @if( count($sucursales) >= 0 )
                            @foreach ($sucursales as $sucursal)
                                @if ($sucursal->getFarmacia->id_farmacia == $farmacia->id_farmacia)
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-10">
                                            
                                                <p>Descripción: <span class="font-weight-bold text-secondary"><?php echo $sucursal->descripcion_sucursal ?> </span></p>
                                                <p>Cufe: <span class="font-weight-bold text-secondary">{{ $sucursal->cufe_sucursal }} </span></p> 
                                                <p>Email: <span class="font-weight-bold text-secondary">{{ $sucursal->email_sucursal }} </span></p>
                                                <p>Teléfono: <span class="font-weight-bold text-secondary">{{ $sucursal->telefono_sucursal }} </span></p> 
                                                <p>Dirección: <span class="font-weight-bold text-secondary">{{$sucursal->direccion_sucursal }} </span></p>
                                                @if($sucursal->habilitado == 1)
                                                    <span class="text-left text-success">Estado: habilitada </p>   
                                                @else
                                                    <p class="text-left text-warning">Estado: Deshabilitada </p> 
                                                @endif 
                                                
                                        </div>
                                        <div class="col-2 text-right">
                                            <div class="p-2">    
                                                <a href="{{ route('sucursal.edit', [ $sucursal->id_sucursal]) }}"><i class="material-icons" style="font-size: 40px" data-toggle="tooltip" data-placement="left"  title="Editar sucursal">edit</i></a>
                                            </div>   
                                            <div class="p-2"> 
                                                <a href="" title="Eliminar Sucursal" data-toggle="modal" data-target="#deleteModal" data-id_sucur="{{ $sucursal->id_sucursal}}"><i class="material-icons" style="font-size: 40px" data-placement="left">delete</i></a>
                                            </div>  
                                        </div>                                
                                    </div>
                                    <hr>
                                </div>
                                @endif
                            @endforeach
                        
                        @elseif( count($sucursales) < 1)   
                             <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="p-3 mb-2 bg-warning text-dark">
                                                <p class="font-weight-bold text-center">Atención. Esta Farmacia no posee sucurales cargadas</p>
                                            </div>
                                        </div>
                                     </div>
                             </div>
                        @endif                  
                    </div>
            @endif
    @endforeach
</div>

  <!-- MODAL DELETE -->
    <div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
        <div class="modal-header">
            <h4 class="modal-title text-danger" >Eliminar</h4> 
            <hr>   
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body p-2">
                <div class="container p-4">
                    <h6>¿Está seguro que desea borrar la Sucursal?</h6>
                    <p>Despúes de esta acción no podrá recuperar los datos</p>
                </div>
            </div>
                <div class="modal-footer m-1">
                    <form method="POST" action="">
                        @method('DELETE' )
                        @csrf
                        <button type="submit" class="btn btn-primary">Si</button>
                    </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
        </div>
        </div>
    </div>
    </div>

@endsection
@section('zona_js')
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var boton = $(event.relatedTarget);
        var id_sucursal = boton.data('id_sucur');
        var modal = $(this);
        modal.find('form').attr('action', 'sucursal/' + id_sucursal );    
    });
</script>
@endsection
