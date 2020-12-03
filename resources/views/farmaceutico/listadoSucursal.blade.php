@extends('farmaceutico.indexFarmaceutico')
@section('titulo','Cargar Sucursal')

@section('opcionesFarmaceutico')
<div class="container">


    @if( count($sucursales) > 0 )
    
    <div class="shadow p-3 mb-5 bg-white">
        @foreach($sucursales as $sucursal)
            @if($sucursal->getFarmacia->habilitada == 0)
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="p-3 mb-2 bg-warning text-dark">
                                <p class="font-weight-bold text-center">Atención. La Farmacia {{$sucursal->getFarmacia->nombre_farmacia}} se encuentra esta deshabilitada. Por lo que no podra acceder a sus sucursales que pertenezcan a la misma.</p>
                                <p class="font-weight-bold text-center">Si cree que esto es un error comuniquese con el
                                    administrador.</p>
                            </div>
                        </div>
                    </div>
                </div>

            <!--Hay farmacias habilitadas -->    
            @else
                <div class="row">
                    <div class="col-8">
                        <h2 class="text-secondary  m-3"> {{ $sucursal->getFarmacia->nombre_farmacia }}</h2>
                        <div class="text m-3 p-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Descripción: <span
                                        class="font-weight-bold text-secondary"><?php echo $sucursal->getFarmacia->descripcion_farmacia ?>
                                    </span></li>
                                <li class="list-group-item">CUIT: <span
                                        class="font-weight-bold text-secondary">{{ $sucursal->getFarmacia->cuit }}
                                    </span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-4">
                        <img class="card-img-top" src="{{ asset($sucursal->getFarmacia->img_farmacia) }}"
                            alt="Logotipo" width="100" height="150">
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">

                            
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-1"><i class="material-icons">location_on</i></div>
                                        <div class="col-10"><span class="font-weight-bold text-secondary">{{$sucursal->direccion_sucursal }}</span></div>
                                    </div>
                                </li>                           
                                
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-1"><i class="material-icons">mail</i></div>
                                        <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursal->email_sucursal }} </span></div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-1"><i class="material-icons">local_phone</i></div>
                                        <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursal->telefono_fijo }} </span></div>
                                    </div>
                                </li>


                                @if($sucursal->telefono_movil !=null)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-1">
                                            <i class="fab fa-whatsapp "  style="font-size:25px"></i>
                                        </div>
                                        
                                            <div class="col-10"><span class="font-weight-bold text-secondary">{{$sucursal->telefono_movil }}</span></div>
                                        
                                    </div>
                                </li>
                                @else
                                    <div class="row">
                                        <div class="col-1">   
                                            <p>&nbsp</p>  
                                        </div>
                                    </div>                                                                              
                                @endif
                                <li class="list-group-item" ></li>
                                </ul>        
                            @if($sucursal->habilitado == 1)
                                <span class="text-left text-success">Estado: habilitada </p>
                                @else
                                    <p class="text-left text-warning">Estado: Deshabilitada </p>
                            @endif

                        </div>
                        
                        <!-- Botones -->
                        <div class="col-2 text-right">
                            <div class="p-2">
                                <a
                                    href="{{ route('sucursal.edit', [ $sucursal->id_sucursal]) }}"><i
                                        class="material-icons" style="font-size: 40px" data-toggle="tooltip"
                                        data-placement="left" title="Editar sucursal">edit</i></a>
                            </div>
                            <div class="p-2">
                                <a href="" title="Eliminar Sucursal" data-toggle="modal" data-target="#deleteModal"
                                    data-id_sucur="{{ $sucursal->id_sucursal }}"><i class="material-icons"
                                        style="font-size: 40px" data-placement="left">delete</i></a>
                            </div>
                            <div class="p-2">
                                <a
                                    href="{{ route('medicamentos.cargar',[$sucursal->id_sucursal]) }}"><i
                                        class="material-icons" style="font-size: 40px" data-toggle="tooltip"
                                        data-placement="left" title="Cargar Stock Medicamentos">event_note</i></a>
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
                        <p class="font-weight-bold text-center">Atención. Usted no posee sucurales cargadas</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>


<!-- MODAL DELETE -->
<div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h4 class="modal-title text-danger">Eliminar</h4>
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
        modal.find('form').attr('action', 'sucursal/' + id_sucursal);
    });

</script>
@endsection
