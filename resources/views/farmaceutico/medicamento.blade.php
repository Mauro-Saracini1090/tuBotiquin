@extends('farmaceutico.indexFarmaceutico')
@section('titulo','Cargar Sucursal')

@section('opcionesFarmaceutico')
<div class="container">
    <div class="row justify-content-center">
        <div class=" col-12">
            <div class="shadow p-3 mb-5 bg-white rounded">
                @if(session()->has('medicamento'))
                    <div class="alert alert-primary alert-dismissible fade show focus" role="alert">
                        <h5 class="alert-heading pb-4">Registro Stock Exitoso</h5>
                        <strong>{{ session()->get('medicamento') }}</strong>
                        <br>
                        <hr>
                        <p class="text-right">Equipo TuBotiquín</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- Masthead Subheading-->
                <h3 class="masthead-subheading text-center">CARGAR STOCK DE UN MEDICAMENTO</h3>
                <p class="lead text-center">Complete los siguientes campos</p>
                    @if(count($medicamentos) < 1)
                    <div class="alert alert-warning alert-dismissible fade show focus" role="alert">
                        <p class="text-center">No Hay Medicamentos Registrador en este Momento. Disculpe las molestias.</p>
                        <p class="text-right">Equipo Tu Botiquin.</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                <form method="POST" action="{{route('medicamentos.almacenar',[$sucursal])}}">
                    @csrf
                    @method('PATCH')
                    <!-- select Medicamentos -->
                    <div class="form-group">
                        <strong><label for="medicamento_id">{{ __('Seleccione un Medicamento *') }}</label></strong>

                        <select id="medicamento_id" class="form-control @error('medicamento_id') is-invalid @enderror"
                            name="medicamento_id" value="{{ old('medicamento_id') }}" required autofocus>
                            <option></option>
                            @foreach($medicamentos as $medicamento)
                                <option value="{{ $medicamento->id_medicamento}}">{{ $medicamento->nombre_medicamento}}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Si no encuentra el Medicamento deseado, contacte al Administrador</small>
                        @error('medicamento_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    

                    <!-- Cantidad -->
                    <div class="form-group">
                        <strong><label
                                for="cantidad">{{ __('Cantidad Stock (cajas o recipientes): *') }}</label></strong>
                        <input type="number" name="cantidad" value="{{ old('cantidad') }}" placeholder="Cantidad Stock(cajas o recipientes)" class="form-control @error('cantidad') is-invalid @enderror" min="1" max="50" required>
                        <small class="form-text text-muted">Cantidad Stock</small>

                        @error('cantidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="d-flex d-flex justify-content-left">
                            <small class="form-text text-muted">Los campos marcados con (*) son obligatorios</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-flex d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mr-1">
                                {{ __('Registrar') }}
                            </button>
                            <a href="{{ route('farmacia.index') }}"
                                class="btn btn-primary">Cancelar</a>
                        </div>
                    </div>
                </form>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Medicamento</th>
                        <th scope="col">Ultimo Stock cargado en Sucursal</th>
                        <th scope="col">Stock Total Farmacia {{$sucursal->getFarmacia->nombre_farmacia}}</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($sucursal->getMedicamentos as $medicamentos)
                      <tr>
                         
                            <td>{{$medicamentos->nombre_medicamento}}</td>
                            <td>{{$medicamentos->pivot->cantidad}}</td>
                            <td>{{$medicamentos->pivot->cantidadTotal}}</td>
                            <td>
                                <a class="btn btn-danger my-1" href="#" data-toggle="modal" data-target="#deleteModal" data-sucuid="{{ $sucursal->id_sucursal }}" data-medid="{{ $medicamentos->id_medicamento }}">
                                    Borrar
                                </a>
                            </td>
                      </tr>
                      @endforeach
    
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Esta seguro que desea borrar el Stock de esta Sucursal?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form method="POST" action="">
                    @method('DELETE' )
                    @csrf
                    {{-- <input type="hidden" id="id_rol" name="id_rol" value=""> --}}

                    <button type="submit" class="btn btn-danger">Si</button>
                </form>
                <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('zona_js')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var boton = $(event.relatedTarget);
            var id_sucursal = boton.data('sucuid');
            var id_medicamento = boton.data('medid');

            var modal = $(this);
            //modal.find('.modal-footer #id_rol').val(id_rol);
            //revisar o buscar otra forma
            modal.find('form').attr('action',
                '{{URL::to("/")}}/borrarStockSucursal/'+id_sucursal+'/'+id_medicamento);
        });

    </script>
@endsection