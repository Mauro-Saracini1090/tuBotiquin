@extends('welcome')
@section('titulo','Farmacias y sucursales')

@section('contenido')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="shadow p-4 mb-5 bg-white rounded"> 
                    <!-- Masthead Subheading-->
                    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{ $farmacia->nombre_farmacia}}</h2>
                    <p class="text-center">{{ $farmacia->descripcion_farmacia }}<p>
                        <div class="d-flex d-flex justify-content-center">
                            <figure class="figure">
                                <img src="{{ asset($farmacia->img_farmacia) }}" alt="Logotipo" width="300" height="250" >
                                <figcaption class="figure-caption"></figcaption>
                            </figure>
                        </div>
        
                        @foreach ($arraySucursales as  $sucursal)
                            @if ($sucursal->habilitado == 1)
                            <hr> 
                                <p>{{ $sucursal->descripcion_sucursal}}</p>
                                <p>Cufe {{ $sucursal->cufe_sucursal}}</p> 
                                <p>Email: {{$sucursal->email_sucursal }}</p>              
                                
                            @endif  
                                 
                        @endforeach
            
                </div>
             </div>
        </div>           

@endsection