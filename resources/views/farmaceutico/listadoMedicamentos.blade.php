@extends('farmaceutico.indexFarmaceutico')
@section('titulo', 'Cargar Sucursal')

@section('opcionesFarmaceutico')
<div class="container-fluid  p-0 mx-0">
    <div class="card-body">
        <!-- Masthead Subheading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Medicamentos</h2>
        <p class="lead text-center my-3">Listado de sus Medicamentos</p>
    </div>
    @if(count($sucursales) > 0)
        <div class="shadow bg-white p-0 mx-0 container-fluid">
            <div class="card-body table-responsive p-0 mx-0 container-fluid">
                <table id="table-medicamentos" class="table table-striped container-fluid p-2 mx-0">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th scope="col">Farmacia</th>
                            <th scope="col">Medicamento</th>
                            <th scope="col">Informacion</th>
                            <th scope="col">Stock cargado por Sú Sucursal</th>
                            <th scope="col">Stock Total en Farmacia </th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Marca</th>
                        </tr>
                        <tr>
                            <form class="form-inline d-flex d-flex justify-content-center" method="GET" action="{{ route('medicamentos.listado') }}">
                                <td>
                                    <button type="submit" class="btn btn-primary mx-2"><i class="fas fa-search" aria-hidden="true"></i></button>
                                </td>
                                <td>
                                    <button id="resetbusqueda" type="reset" class="btn btn-primary"><i class="fas fa-sync"></i></button>
                                </td>
                                <td>
                                    <input id="nombreFarmacia" type="text" placeholder="Farmacia"><input id="farmacia_id" name="farmacia_id" hidden>
                                    </td>
                                <td>
                                    <input id="nombreMedicamento" type="text" placeholder="Medicamento"><input id="medicamento_id" name="medicamento_id" hidden>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input id="tipoMedicamento" type="text" placeholder="Tipo Medicamento"><input id="tipo_id" name="tipo_id" hidden></td>
                                <td><input id="marcaMedicamento" type="text" placeholder="Marca Medicamento"><input id="marca_id" name="marca_id" hidden></td>
                            </form>

                        </tr>
                    </thead>
                    @foreach($sucursales as $sucursal)
                        <tbody>
                            @foreach( $sucursal->getMedicamentos()->NombreMedicamento($medica)->Tipo($tipo)->Marca($marca)->get() as $medicamentos)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $sucursal->getFarmacia->nombre_farmacia }}</td>
                                    <td>{{ $medicamentos->nombre_medicamento }}</td>
                                    <td>{{ $medicamentos->informacion }}</td>
                                    <td>{{ $medicamentos->pivot->cantidad }}</td>
                                    <td>{{ $medicamentos->pivot->cantidadTotal }}</td>
                                    <td>{{ $medicamentos->getTipo->nombre_tipo }}</td>
                                    <td>{{ $medicamentos->getMarca->nombre_marca }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    @elseif( count($sucursales) < 1) <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="p-3 mb-2 bg-warning text-dark">
                    <p class="font-weight-bold text-center">Atención. Usted no posee Medicamentos cargados</p>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Esta seguro que desea borrar el Stock de esta Sucursal?
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form method="POST" action="">
                    @method('DELETE' )
                    @csrf
                    {{-- <input type="hidden" id="id_rol" name="id_rol" value="">
                        --}}

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
    $('#resetbusqueda').click(function(){
        history.pushState(null, "", "listadoStock");
        location.reload();
    });
    
</script>
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var boton = $(event.relatedTarget);
        var id_sucursal = boton.data('sucuid');
        var id_medicamento = boton.data('medid');

        var modal = $(this);
        //modal.find('.modal-footer #id_rol').val(id_rol);
        //revisar o buscar otra forma
        modal.find('form').attr('action', '{{ URL::to('/') }}/borrarStockSucursal/' +
            id_sucursal + '/' + id_medicamento);
    });

</script>
<script>
    $(function () {
        $('#nombreFarmacia').autocomplete({
            source: function (request, response) {
                $.getJSON('{{ route("autocomplete.farmacia") }}?term=' + request
                    .term,
                    function (data) {
                        var array = $.map(data, function (row) {
                            return {
                                value: row.nombre_farmacia,
                                label: row.nombre_farmacia,
                                name: row.id_farmacia,


                            }
                        })
                        response($.ui.autocomplete.filter(array, request.term));
                    })
            },
            minLength: 1,
            delay: 400,
            select: function (event, ui) {
                $('#farmacia_id').val(ui.item.name)
            }
        })
    })

</script>
<script>
    $(function () {
        $('#nombreMedicamento').autocomplete({
            source: function (request, response) {
                $.getJSON('{{ route("autocomplete") }}?term=' + request.term,
                    function (data) {
                        var array = $.map(data, function (row) {
                            return {
                                value: row.nombre_medicamento,
                                label: row.nombre_medicamento,
                                name: row.id_medicamento,

                            }
                        })
                        response($.ui.autocomplete.filter(array, request.term));
                    })
            },
            minLength: 1,
            delay: 400,
            select: function (event, ui) {
                $('#medicamento_id').val(ui.item.name)
            }
        })
    })

</script>
<script>
    $(function () {
        $('#tipoMedicamento').autocomplete({
            source: function (request, response) {
                $.getJSON('{{ route("autocomplete.tipo") }}?term=' + request.term,
                    function (data) {
                        var array = $.map(data, function (row) {
                            return {
                                value: row.nombre_tipo,
                                label: row.nombre_tipo,
                                name: row.id_tipo,

                            }
                        })
                        response($.ui.autocomplete.filter(array, request.term));
                    })
            },
            minLength: 1,
            delay: 400,
            select: function (event, ui) {
                $('#tipo_id').val(ui.item.name)
            }
        })
    })

</script>
<script>
    $(function () {
        $('#marcaMedicamento').autocomplete({
            source: function (request, response) {
                $.getJSON('{{ route("autocomplete.marca") }}?term=' + request
                    .term,
                    function (data) {
                        var array = $.map(data, function (row) {
                            return {
                                value: row.nombre_marca,
                                label: row.nombre_marca,
                                name: row.id_marca,

                            }
                        })
                        response($.ui.autocomplete.filter(array, request.term));
                    })
            },
            minLength: 1,
            delay: 400,
            select: function (event, ui) {
                $('#marca_id').val(ui.item.name)
            }
        })
    })

</script>
@endsection
