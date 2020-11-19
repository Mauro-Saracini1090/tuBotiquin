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
                                        <h2 class="text-secondary  m-3">{{ $farmacia->nombre_farmacia }}</h2>
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
                                                        <a href="" title="Eliminar Farmacia" data-toggle="modal" data-target="#deleteModal" data-id_farma="{{ $farmacia->id_farmacia}}"><i class="material-icons" style="font-size: 40px" data-placement="left"  ">delete</i></a>
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
                    <h6>¿Está seguro que desea borrar la Farmacia?</h6>
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
        var id_farmacia = boton.data('id_farma');
        var modal = $(this);
        modal.find('form').attr('action', 'farmacia/' + id_farmacia );    
    });
</script>
@endsection