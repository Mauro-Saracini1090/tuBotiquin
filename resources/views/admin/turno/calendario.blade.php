@extends('admin.administrador')
@section('datos')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
    <h1 class="h2">Asignar Turno</h1>
</div>

<div id='calendar' class="col-8 m-auto"></div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Esta seguro que desea borrar este Rol?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form method="POST" action="">
                    @method('DELETE' )
                    @csrf
                    {{-- <input type="hidden" id="id_rol" name="id_rol" value=""> --}}

                    <button type="submit" class="btn btn-primary">Si</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Turno -->
<div class="modal fade" id="turnoModal" tabindex="-1" aria-labelledby="turnoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="turnoModalLabel">Seleccione una sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 350px;">
                @isset($sucursales)
                <form action="{{ route('turno.store') }}" method="post" id="formTurnos">
                    @csrf
                    @foreach($sucursales as $sucursal)
                        <div class="form-check">
                            <input name="arrSu[]" class="form-check-input" type="checkbox" value="{{ $sucursal->id_sucursal}}" id="{{$sucursal->id_sucursal}}">
                            <label class="form-check-label" for="defaultCheck1">
                                {{ $sucursal->getFarmacia->nombre_farmacia }} - 
                                {{ $sucursal->descripcion_sucursal }} - Direccion
                            </label>
                        </div>
                    @endforeach
                    <input name="turnoFecha" id="turnoFecha" type="text" value="" hidden>
                    <input name="usuario" id="usuario" type="text" value="{{auth()->user()->id_usuario}}" hidden>
                </form>
                @else
                      <p>No hay sucursales registradas</p> 
                @endisset
            </div>
            <div class="modal-footer">
                <button id="guardarTurno" type="button" class="btn btn-success">Actualizar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

            </div>
        </div>
    </div>
</div>

@endsection
@section('zona_js')
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var boton = $(event.relatedTarget);
        var id_rol = boton.data('roleid');

        var modal = $(this);
        //modal.find('.modal-footer #id_rol').val(id_rol);
        //revisar o buscar otra forma
        modal.find('form').attr('action',
            'roles/' + id_rol);
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            headerToolbar: {
                left: 'today',
                center: 'title',
                right: 'prev,next',
            },
            views: {
            dayGridMonth: { // name of view
                titleFormat: { year: 'numeric', month: 'long' } 
                // other view-specific options here
                }
            },

            
            events: [
        @foreach ($sucursales as $sucursal)
            @if((!($sucursal->getTurnos->isEmpty())))
                @foreach ($sucursal->getTurnos as $turnoSuc)
                    @foreach ($turnos as $turno)
                        @if("{{$turnoSuc->fecha_turno}}" == "{{$turno->fecha_turno}}")
                            
                                {
                                title  : '{{$sucursal->getFarmacia->nombre_farmacia}}{{$sucursal->direccion_sucursal}}',
                                start  : '{{$turnoSuc->fecha_turno}}',
                                },
                        @endif
                    @endforeach
                @endforeach
            @endif   
        @endforeach
        ]
        });
        calendar.on('dateClick', function (info) {
            $('#turnoFecha').val(info.dateStr);
            var fecha = $('#turnoFecha').val();
            //console.log($('#turnoFecha').val());
            
            @foreach ($sucursales as $sucursal)
            console.log("{{$sucursal->getTurnos}}")
            $("#{{$sucursal->id_sucursal}}").prop("checked", false);
                @foreach ($sucursal->getTurnos as $article)
                    
                    if("{{$article->fecha_turno}}" == fecha){
                        $("#{{$sucursal->id_sucursal}}").prop("checked", true);
                        //console.log("{{$article->fecha_turno}}");
                    }
                @endforeach
            @endforeach
            
            $('#turnoModal').modal();
           //console.log('clicked on ' + info.dateStr);


        });
        calendar.setOption('locale', 'Es');
        calendar.render();

        $('#guardarTurno').click(function(){
            $('#formTurnos').submit();
        });
    });

</script>
@endsection
