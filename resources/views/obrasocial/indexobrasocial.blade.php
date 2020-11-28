@extends('farmaceutico.indexFarmaceutico')
@section('titulo','Farmacias y sucursales')

@section('opcionesFarmaceutico')
    <div class="container">
            <div class="col-12 ">
             
                @foreach ($arrayObraSocial as $obrasocial)

                    <div class="shadow bg-white"> 
                        <div class="p-0 mb-2 fondo text-left">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><h4 class="text-secondary">{{ $obrasocial->Nombre_obra_social }}</h4></li>
                                <li class="list-group-item"><p> Teléfono de contacto: {{ $obrasocial->Telefono_obra_Social  }}</p></li>
                            </ul>
                        </div>
                    </div>             
                @endforeach
             </div>
     
    <!-- Pagination for 6 elements -->
         <div class="d-flex d-flex justify-content-center mt-4"> 
                 {{ $arrayObraSocial->links() }}
         </div>
    </div>         
@endsection