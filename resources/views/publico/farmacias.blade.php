@extends('welcome')
@section('titulo', 'Farmacias')

@section('contenido')
    <div class="container">

       
            <div class="card-body mb-2">
                <!-- Masthead Subheading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Farmacias</h2>
                <p class="lead text-center my-3">Listado de las farmacias disponibles en la plataforma</p>
                <!-- Search form -->
                <form class="form-inline d-flex d-flex justify-content-center" method="GET" action="{{ route('farmacias') }}">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input class="form-control form-control-sm ml-3 w-75" name="busquedafarmacia" type="text" placeholder="Search" aria-label="Search">
                    <button type="submit" class="btn btn-primary mx-2">
                        {{ __('Buscar') }}
                    </button>
                    <button id="resetbusqueda" type="reset" class="btn btn-primary">
                        {{ __('Limpiar') }}
                    </button>
                </form>
            </div>

        @if (!count($arrayFarmaciasPaginate) < 1)
            <div class="container">
                <div class="row">
                    @foreach ($arrayFarmaciasPaginate as $farmaciaPaginate)
                        @if ($farmaciaPaginate->habilitada == 1)
                            <div class="col-lg-4 col-12 mt-4">
                                <div class="shadow bg-white">
                                    <div class="col-12 bg-encabezado mb-3 p-3">
                                    </div>
                                    <div class="d-flex d-flex justify-content-center">
                                        <div class="col-6">
                                            <img class="card-img-top rounded shadow"
                                                src="{{ asset($farmaciaPaginate->img_farmacia) }}" alt="Logotipo" width="110"
                                                height="110">
                                        </div>
                                    </div>
                                    <div class="card-body text-center">
                                        <h4 class="card-title"> <?php echo
                                            strtoupper($farmaciaPaginate->nombre_farmacia); ?></h4>
                                        <p class="font-italic"><?php echo $farmaciaPaginate->descripcion_farmacia;
                                            ?></p>
                                        <hr>
                                        <form method="POST" action="{{ route('farmaciaSucursal') }}">
                                            @csrf
                                            <input type="hidden" name="id_farmacia" value={{ $farmaciaPaginate->id_farmacia }}>
                                            <button type="submit" class="btn btn-link mx-2">
                                                {{ __('Ver Sucursales') }}
                                            </button>
                                        </form>
                                        @can('esRegistrado')
                                            <div class="p-2">
                                                <a href="{{ route('listado.medicamentos', [$farmaciaPaginate->id_farmacia]) }}"><i
                                                        class="material-icons" style="font-size: 40px" data-toggle="tooltip"
                                                        data-placement="left"
                                                        title="Listado Medicamentos de {{ $farmaciaPaginate->nombre_farmacia }}">event_note</i></a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Pagination for 6 elements -->
                <div class="d-flex d-flex justify-content-center mt-4">
                    {{ $arrayFarmaciasPaginate->links() }}
                </div>

        @else
            <div class="row">
                <div class="col-12 text-center">
                    <div class="p-3 mb-2 bg-warning rounded shadow text-dark ">
                        <h6 class="font-weight-bold text-center mb-2">Atención. Ocurrio un error en la búsqueda, intentelo
                            nuevamente mas tarde</h6>
                        <br>
                        <p>Disculpe las Molestias. <strong>Equipo tuBotiquín</strong></p>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
@section('zona_js')
    <script>
        $('#resetbusqueda').click(function(){
            history.pushState(null, "", "farmacias");
            location.reload();
        });
        
    </script>
@endsection
