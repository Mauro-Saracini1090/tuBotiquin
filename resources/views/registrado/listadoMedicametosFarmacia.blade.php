@extends('welcome')
@section('titulo', 'Farmacias')

@section('contenido')
<div class="container">
    @if(session()->has('clear'))
        <div class="container">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="text-left alert alert-warning alert-dismissible fade show" role="alert">
                        <p class="font-weight-bold">{{ session()->get('clear') }}</p>
                        <strong>
                            <p class="text-right">Equipo TuBotiquín</p>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Section of  alert mail contac send -->
    @if(session()->has('success'))
        <div class="container">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="text-left alert alert-success alert-dismissible fade show" role="alert">
                        <p class="font-weight-bold">{{ session()->get('success') }}</p>
                        <strong>
                            <p class="text-right">Equipo TuBotiquín</p>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(!count($arrayMedicamentos) < 1)
        <div class="card-body mb-2">
            <!-- Masthead Subheading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Farmacia</h2>
            <p class="lead text-center my-3">Listado de Medicamentos en la Farmacia {{ $farmacia->nombre_farmacia }}
            </p>
        </div>
        <div class="row">
            @foreach($arrayMedicamentos as $medicamentos)
                @if($medicamentos->pivot->cantidadTotal > 0)
                    <div class="col-lg-3 col-md-6 col-12 mt-4">
                        <div class="bg-encabezado p-3"></div>
                        <div class="shadow bg-white">

                            <div class="d-flex d-flex justify-content-center">
                                <div class="col-7">
                                    <img class="card-img-top shadow" src="{{ asset($medicamentos->img_medicamento) }}"
                                        alt="Logotipo {{ $medicamentos->nombre_medicamento }}" width="110"
                                        height="110">
                                </div>
                            </div>

                            <div class="card-body text-center">
                                <h4 class="card-title"> <?php echo strtoupper($medicamentos->nombre_medicamento); ?>
                                </h4>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="infomedicamento btn btn-primary" data-toggle="modal" data-target="#infomodal" data-medid="{{ $medicamentos->id_medicamento }}">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                    </li>

                                </ul>
                                <div class="border border-ligth rounded p-2">
                                    <span class="font-italic">Disponible:
                                        <strong><?php echo $medicamentos->pivot->cantidadTotal;?></strong>
                                    </span>
                                    <form action="{{ route('cart.add') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="producto_id"
                                            value="{{ $medicamentos->id_medicamento }}">

                                        <input type="hidden" name="cantidad_total"
                                            value="{{ $medicamentos->pivot->cantidadTotal }}">
                                        <input type="hidden" name="farmacia_id" value="{{ $farmacia->id_farmacia }}">

                                        <input class="form-control col-6 mx-auto px-2 text-center" type="number"
                                            name="cantidad" value="1" min="1"
                                            max="@if($medicamentos->pivot->cantidadTotal >= 5){{ 5 }}@else{{ $medicamentos->pivot->cantidadTotal }}@endif"
                                            required>
                                        <small class="form-text text-muted">Reserva máxima cinco unidades</small>
                                        <input type="submit" name="btn" class="btn btn-success mt-2" value="Reservar">
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="row">
            <div class="col-12 text-center">
                <div class="p-3 mb-2 bg-warning rounded shadow text-dark ">
                    <h6 class="font-weight-bold text-center mb-2">
                        <i class="large material-icons align-middle mx-1" style="font-size: 40px">warning</i>
                        Atención. Ocurrio un error en la búsqueda, intentelo nuevamente mas tarde.
                    </h6>
                    <br>
                    <p>Disculpe las Molestias. <strong>Equipo tuBotiquín</strong></p>
                </div>
            </div>
        </div>
    @endif
    <!-- Modal -->
<div class="modal fade" id="infomodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="infomodalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-encabezado bg-encabezado" id="modal-header">
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body" id="modal-body">
          ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('zona_js')
    <script>
        $(document).ready(function () {
        $('.infomedicamento').on('click', function () {
                $('#modal-header').html('');
                $('#modal-body').html('');
                var titulo = "";
                var body = "";
                var medicamentos_id = $(this).data('medid');
                // console.log(medicamentos_id);
                
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        url: "{{ route('informacion.medicamento')}}",
                        type: 'get',
                        dataType: 'json',
                        data: {
                            medicamentos_id: medicamentos_id,
                        }
                    }).done(function(data) {
                        // console.log(data);          
                        // console.log(data.get_marca);
                        titulo = "<h4>Informacion sobre " + data.nombre_medicamento +"</h4>";
                        body = "<p><strong>Detalles:</strong> "+ data.informacion +"</p>";
                        body += "<p><strong>Nombre Generico:</strong> "+ data.get_marca.nombre_marca +"</p>";
                        body += "<p><strong>Tipo:</strong> "+ data.get_tipo.nombre_tipo +"</p>";

                        $('#modal-header').html(titulo);
                        $('#modal-body').html(body);
                    });
                });
        });
    </script>
@endsection
