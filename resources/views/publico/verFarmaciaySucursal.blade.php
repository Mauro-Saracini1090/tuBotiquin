@extends('welcome')
@section('titulo','Farmacias y sucursales')

@section('contenido')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="shadow bg-white"> 
                <div class="col-12 bg-encabezado mb-3 p-4">
                </div>
                    <!-- Masthead Subheading-->
                    @if( !(empty($farmacia)  && empty($arraySucursales)))
                     <div class="row" >
                            <div Class="col-lg-8 col-12 mt-4">
                                    <h2 class="page-section-heading text-uppercase text-secondary text-center"><?php echo strtoupper($farmacia->nombre_farmacia ) ?></h2>
                                    <div class="text  text-center">   
                                        <p> <?php echo $farmacia->descripcion_farmacia ?><p>
                                    </div>   
                                    </div>
                                    <div Class="col-lg-3 col-12">
                                    <div class="d-flex justify-content-center m-3">
                                            <figure class="figure">
                                                <img class="shadow img-rounded" src="{{ asset($farmacia->img_farmacia) }}" width="150" alt="Imagen Logo">
                                            </figure>
                                    </div>
                            </div>
                      </div>

                    @if( !(count($arraySucursales)) < 1 )
                        <!-- Sucursales -->
                        <!-- Mostrar primero la sede central -->
                        @if(count($arraySucursales) > 0 )
                            <h4 class="text-secondary  m-3">Nuestras sucursales</h4>
                            <hr>
                        @elseif(count($arraySucursales) == 0 )
                            <h4 class="text-secondary  m-3">Nuestra sucursal</h4>
                            <hr>    
                        @endif       
                        @foreach ($arraySucursales as  $sucursal)
                           
                            @if ($sucursal->habilitado == 1)
                                <div class="row">
                                    <div Class="col-lg-7 col-12 " >
                                        <div class="text ml-5 p-1"> 
                                           <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><i class="material-icons">access_time</i> <span class="font-weight-bold text-secondary"> <?php echo $sucursal->descripcion_sucursal ?></li>
                                                <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-1"><i class="material-icons">location_on</i></div>
                                                            <div class="col-10"><span class="font-weight-bold text-secondary">{{$sucursal->direccion_sucursal }}</span></div>
                                                        </div>
                                                    </li>                           
                                                    
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-1"><i class="material-icons">mail</i></div>
                                                            <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursal->email_sucursal }} </span></div>
                                                        </div>
                                                    </li>

                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-1"><i class="material-icons">local_phone</i></div>
                                                            <div class="col-10"><span class="font-weight-bold text-secondary">{{ $sucursal->telefono_fijo }} </span></div>
                                                        </div>
                                                    </li>
                                                    @if($sucursal->telefono_movil !=null)
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fab fa-whatsapp"  style="font-size:25px"></i>
                                                            </div>
                                                            <div class="col-10">
                                                                <span class="font-weight-bold text-secondary">
                                                                    <a target="_blank"  href="https://api.whatsapp.com/send?phone={{ $sucursal->telefono_movil }}&text=Hola,%20¿te puedo hacerte una consulta?">Consultanos!</a>   
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </li>                                      
                                                    @else
                                                        <div class="row">
                                                            <div class="col-1 m-2">   
                                                                <p>&nbsp</p>  
                                                            </div>
                                                        </div>                                                                              
                                                     @endif
                                                    <li class="list-group-item"></li>
                                                </ul> 
                                        </div>
                                    </div>  
                                
                                    <div Class="col-lg-5 col-12">
                                        <div class="d-flex d-flex justify-content-center">
                                                <div class="mapa" id="{{$sucursal->id_sucursal}}">
                                                
                                                </div>
                                        </div>   
                                    </div>
                                    <div class="col-12">
                                        <hr>    
                                    </div>
                                </div>
                            @endif  
                             
                        @endforeach
                    @else
                    <div class="row">
                        <div class="col-12">

                                <div class="p-3 mb-2 bg-warning text-dark">
                                    <h6 class="font-weight-bold text-center"> Atención - Esta Farmacia no posee sucursales cargadas</h6>
                                </div>
                            </div>
                    </div>        
                    @endif

                         @if( !(count($arrayObraSociales)) < 1 )
                            <!-- Obra Sociales -->
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="text-secondary m-3">Obras sociales</h4>
                                        <div class="p-4">
                                        <ul class="list-inline">
                                        @foreach($arrayObraSociales as $obraSocial)
                                            <li class="list-inline-item m-2"> {{$obraSocial->Nombre_obra_social }} </li> 
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @else  
                             <div class="row">
                                <div class="col-12">
                                <h4 class="text-secondary  m-3">Obras sociales</h4>
                                    <div class="p-3 mb-2 bg-warning text-dark">
                                        <h6 class="font-weight-bold text-center">Esta Sucursal Farmaceutica no posee Obras Sosciales cargadas</h6>
                                    </div>
                                </div>
                        </div>
                        @endif 
                    @else
                        <div class="row">
                                <div class="col-12">
                                    <div class="p-3 mb-2 bg-warning text-dark ">
                                        <h6 class="font-weight-bold text-center">Atención. Ocurrio un error en la búsqueda, intentelo nuevamente mas tarde</h6>
                                    </div>
                                </div>
                        </div>

                    @endif     
                </div>
             </div>
        </div>           
@endsection
@section('zona_js')
<script>   
    @foreach ($arraySucursales as  $sucursal)
        @if ($sucursal->habilitado == 1)
         var latitud = {{ $sucursal->sucursal_latitud }};
         var longitud = {{ $sucursal->sucursal_longitud }};
        if ($.isNumeric(latitud) && $.isNumeric(longitud) ) {
              
             var map = L.map('{{$sucursal->id_sucursal}}').setView({
                 lon: longitud,
                  lat: latitud
              }, 16);
             var actual = L.marker([latitud, longitud]).addTo(map).bindPopup('{{$farmacia->nombre_farmacia}}').openPopup();
          }else{
            var map = L.map('{{$sucursal->id_sucursal}}').setView({
                lon: -67.8284165,
                lat: -38.9793436
            }, 15);
        }
        // add the OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
        }).addTo(map);

        // show the scale bar on the lower left corner
        L.control.scale().addTo(map);
        
        $('#{{$sucursal->id_sucursal}}').mouseenter(function(){
            map.scrollWheelZoom.enable();
            map.dragging.enable();
            map.touchZoom.enable();
            map.doubleClickZoom.enable();
            map.boxZoom.enable();
            map.keyboard.enable();
            if (map.tap) map.tap.enable();
            $('#{{$sucursal->id_sucursal}}').css('cursor', 'drag');
        })
        $('#{{$sucursal->id_sucursal}}').mouseleave(function(){
            map.scrollWheelZoom.disable();
            map.dragging.disable();
            map.touchZoom.disable();
            map.doubleClickZoom.disable();
            map.boxZoom.disable();
            map.keyboard.disable();
            if (map.tap) map.tap.disable();
            $('#{{$sucursal->id_sucursal}}').css('cursor', 'drag');
        })
        @endif  
    @endforeach
</script>
@endsection