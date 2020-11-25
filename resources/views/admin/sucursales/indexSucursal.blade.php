@extends('admin.administrador')
@section('titulo', 'Listado Sucursales')
@section('datos')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 border-bottom">
    <h1 class="h2">Lista de Sucursales</h1>
</div>
<a href="{{ route('sucursal.create') }}" class="btn btn-panel float-right my-2">Cargar nueva Sucursal</a>
<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Farmacia Acargo</th>
            <th scope="col">CUFE</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col">Habilitada?</th>
            <th scope="col">Borrado Logico Aplicado?</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($sucursales as $sucursal)
       
            <tr>
                <td>{{ $sucursal->getFarmacia->nombre_farmacia}}</td>
                <td>{{ $sucursal->cufe_sucursal }}</td>
                <td>{{ $sucursal->email_sucursal }}</td>
                <td>{{ $sucursal->telefono_sucursal }}</td>
                <td>{{ $sucursal->habilitado }}</td>
                <td>{{ $sucursal->borrado_logico_sucursal }}</td>
                <td>
                    <a class="btn btn-panel my-1" href="{{ route('sucursal.show', [$sucursal->id_sucursal]) }}">ver</a><br>
                    <a class="btn btn-panel my-1" href="{{ route('sucursal.edit', [$sucursal->id_sucursal]) }}">Editar</a><br>
                    <a class="btn btn-panel my-1" href="#" data-toggle="modal" data-target="#deleteModal" data-sucuid="{{ $sucursal->id_sucursal }}">
                        Borrar
                    </a>
                </td>
            </tr>
        @endforeach


    </tbody>
</table>
<div class="d-flex d-flex justify-content-center mt-4"> 
    {{ $sucursales->links() }}
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Esta seguro que desea borrar esta Sucursal?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form method="POST" action="">
                    @method('DELETE' )
                    @csrf
                    {{-- <input type="hidden" id="id_rol" name="id_rol" value=""> --}}

                    <button type="submit" class="btn btn-panel">Si</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
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

            var modal = $(this);
            //modal.find('.modal-footer #id_rol').val(id_rol);
            //revisar o buscar otra forma
            modal.find('form').attr('action',
                'borrarSucursal/'+id_sucursal);
        });

    </script>
@endsection



