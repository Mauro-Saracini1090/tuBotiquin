@extends('welcome')
@section('titulo','Farmacias y sucursales')

@section('contenido')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="shadow p-3 mb-5 bg-white rounded"> 
            <!-- Masthead Subheading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{ $farmacia->nombre_farmacia}}</h2>
            <p class="text-center">{{ $farmacia->descripcion_farmacia }}<p>
             <div class="d-flex d-flex justify-content-center">
                    <figure class="figure">
                        <img src="..{{ $farmacia->img_farmacia }}" width="200" class="figure-img img-fluid rounded" >
                        <figcaption class="figure-caption"></figcaption>
                    </figure>
                </div>

            <hr>
        </div>
         
        <div>
            @foreach ($arraySucursales as  $sucursal)
                @if ($sucursal->habilitado == 1)
                 
                    <div class="shadow p-3 mb-5 bg-white rounded">
    
                            <p>{{ $sucursal->descripcion_sucursal}}</p>
                            <p>Cufe {{ $sucursal->cufe_sucursal}}</p> 
                            <p>Email: {{$sucursal->email_sucursal }}</p>              
                                
                        </div>
                    </div> 
                 @endif           
            @endforeach
    </div>   

@endsection