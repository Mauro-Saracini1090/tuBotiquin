@extends('admin.administrador')
@section('datos')
<div class="row mt-2">
    <div class="col align-bottom">
        <span class="align-bottom">
            <h3 class="">Informacion de Medicamento {{ $medicamento->nombre_medicamento }}</h3>
        </span>
    </div>
</div>
<table class="table table-dark">
    <tbody>
        <tr>
            <th scope="col" style="width: 27%">#ID</th>
            <th scope="row">{{ $medicamento->id_medicamento }}</th>
        </tr>
        <tr>
            <th scope="col">Nombre Medicamentos</th>
            <td>{{ $medicamento->nombre_medicamento}}</td>
        </tr>
        <tr>
            <th scope="col">Informacion</th>
            <td>{{ $medicamento->informacion}}</td>
        </tr>
        <tr>
            <th scope="col">Tipo</th>
            <td>{{ $medicamento->getTipo->nombre_tipo}}</td>
        </tr>
        <tr>
            <th scope="col">Marca</th>
            <td>{{ $medicamento->getMarca->nombre_marca}}</td>
        </tr>
        <tr>
            <th scope="col">Fecha Actualizacion</th>
            <td>{{$medicamento->updated_at}}</td>
        </tr>
        <tr>
            <th scope="col">Fecha Creacion</th>
                <td>
                    {{$medicamento->created_at}}
                </td>
        </tr>
    </tbody>
</table>
<a href="{{ route('medicamentos.index') }}" class="btn btn-secondary">Volver Atras</a>
@endsection
