@extends('welcome')
@section('titulo', 'Farmacias')

@section('contenido')
<div class="container ">
    <div class="row shadow">
        <div class="col-12 bg-encabezado mb-3 p-2">
            <h2 class="text-center text-white"> MIS RESERVAS</h2>
        </div>
    
    <!-- Section of  alert mail contac send -->
    @if(session()->has('borrado'))
      
                <div class="col-12 mx-auto bg-white">
                    <div class="text-left alert alert-success alert-dismissible fade show" role="alert">
                        <p class="font-weight-bold">{{ session()->get('borrado') }}</p>
                        <strong>
                            <p class="text-right">Equipo TuBotiquín</p>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
         
    @endif
    <!-- Section of  alert mail contac send -->
    @if(session()->has('reservaconfirmada'))
     
                <div class="col-12 mx-auto bg-white">
                    <div class="text-left alert alert-success alert-dismissible fade show" role="alert">
                        <p class="font-weight-bold">{{ session()->get('reservaconfirmada') }}</p>
                        <strong>
                            <p class="text-right">Equipo TuBotiquín</p>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
        
    @endif
    <!-- Section of  alert mail contac send -->
    @if(session()->has('overflow'))
       
                <div class="col-12 mx-auto bg-white">
                    <div class="text-left alert alert-warning alert-dismissible fade show" role="alert">
                        <p class="font-weight-bold">{{ session()->get('overflow') }}</p>
                        <strong>
                            <p class="text-right">Equipo TuBotiquín</p>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            
        </div>
    @endif
    @can('esRegistrado')
        <!-- Section of  Cancelar Reserva -->
        @if(session()->has('cancelar'))
           
                    <div class="col-12 mx-auto bg-white">
                        <div class="text-left alert alert-warning alert-dismissible fade show" role="alert">
                            <p class="font-weight-bold">{{ session()->get('cancelar') }}</p>
                            <strong>
                                <p class="text-right">Equipo TuBotiquín</p>
                            </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
              
        @endif
    @endcan
  
        <div class="col-12 bg-white">
            @if(count(Cart::getContent()))
                <div class="table table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>FARMACIA</th>
                            <th>NOMBRE</th>
                            <th>CANTIDAD</th>
                            <th>STOCK TOTAL DISPONIBLE</th>
                        </thead>
                        <tbody>
                            @foreach(Cart::getContent() as $item)

                                <tr>
                                    <td>{{ $farmacia->nombre_farmacia }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->total }}</td>
                                    <td>
                                        <form action="{{ route('cart.removeitem') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="hidden" name="total" value="{{ $item->quantity }}">
                                            <input type="hidden" name="farmacia" value="{{ $farmacia }}">
                                            <button type="submit" class="btn btn-link btn-sm text-danger">X</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
                   
                <form method="POST" action="{{ route('cart.confirmar-reserva') }}">
                    @csrf
                    @foreach(Cart::getContent() as $item)

                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <input name="medicamentos[]" type="hidden" value="{{ $item->id }}">
                        <input text-white name="cantidad[{{$item->id}}]" type="hidden" value="{{ $item->quantity }}">

                    @endforeach

                    <!-- select Farmacias -->
                    <div class="form-group">
                        <strong>
                            <label
                                for="id_sucursal">{{ __('Seleccione una Sucursal para el Retiro *') }}
                            </label>
                        </strong>
                        <select id="id_sucursal" class="form-control @error('id_sucursal') is-invalid @enderror"
                            name="id_sucursal" value="{{ old('id_sucursal') }}" required>
                            <option></option>

                            @foreach($farmacia->getSucursales as $item)
                            @if($item->habilitado == 1)
                                <option value="{{ $item->id_sucursal }}">
                                    {{ $item->getFarmacia->nombre_farmacia }} - Direccion:
                                    {{ $item->direccion_sucursal }}
                                </option>
                                @endif
                            @endforeach
                        </select>
                        <small class="form-text text-muted">
                            Si no encuentra su farmacia, contacte al Administrador
                        </small>
                    </div>
                    <div class="form-group">
                        <div class="d-flex d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mr-1">
                                {{ __('Confirmar Reserva') }}
                            </button>
                            <a href="{{ route('cart.cancelar-reserva') }}"
                                class="btn btn-primary">Cancelar Reserva</a>
                        </div>
                    </div>
                </form>
            </div>
            @else
                <div class="row mt-4">
                <div class="col-12 bg-white">
                    
                    <h5 class="text-center my-auto align-middle mt-3">CARRITO VACIO<i class="material-icons align-middle ml-2">remove_shopping_cart</i></h5>
                    <p class=" text-center">No posee articulos en su carrito</p>
                    <div class="d-flex d-flex justify-content-center m-3"> 
                      <a href=" {{ route('farmacias') }}" type="button" class="btn btn-primary" >Volver a Farmacias</a>
                    </div>    
                </div>    
            </div>
            @endif

        </div>
    </div>
    </div>
</div>
@endsection