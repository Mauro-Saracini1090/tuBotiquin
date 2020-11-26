@extends('farmaceutico.indexFarmaceutico')
@section('titulo','Cargar Sucursal')

@section('opcionesFarmaceutico')
<div class="container">
    <div class="row justify-content-center">
        <div class=" col-12">
            <div class="shadow p-3 mb-5 bg-white rounded">

                <!-- Masthead Subheading-->
                <h3 class="masthead-subheading text-center">CARGAR SUCURSAL</h3>
                <p class="lead text-center">Complete los siguientes campos</p>

                <form method="POST" action="{{ route('sucursal.store') }}">
                    @csrf

                    <!-- select Farmacias -->
                    <div class="form-group">
                        <strong><label
                                for="id_farmacia">{{ __('Seleccione su Farmacia *') }}</label></strong>

                        <select id="id_farmacia" class="form-control @error('Farmacia') is-invalid @enderror"
                            name="id_farmacia" value="{{ old('id_farmacia') }}" required>
                            <option></option>
                            @foreach($arrayFarmacias as $farmacia)
                                <option value="{{ $farmacia->id_farmacia }}">
                                    {{ $farmacia->nombre_farmacia }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Si no encuentra su farmacia, contacte al
                            Administrador</small>
                    </div>

                    <!-- Descripcion -->
                    <div class="form-group">
                        <strong><label
                                for="descripcion_sucursal">{{ __('Descripción *') }}</label></strong>
                        <textarea name="descripcion_sucursal"
                            class="form-control is-invalid @error('descripcion_sucursal')  @enderror"
                            value="{{ old('descripcion_sucursal') }}" rows="3"></textarea>
                        <small class="form-text text-muted">Aca puede colocar los diás y horarios de atención</small>

                        @error('descripcion_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Cufe -->
                    <div class="form-group">
                        <strong><label
                                for="cufe_sucursal">{{ __('Cufe sucursal *') }}</label></strong>
                        <input type="text" name="cufe_sucursal" value="{{ old('cufe_sucursal') }}"
                            class="form-control @error('cufe_sucursal') is-invalid @enderror" required>
                        <small class="form-text text-muted">Sin espacios ni guiones, 8 dígitos mínimo</small>

                        @error('cufe_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">
                        <strong><label for="email_sucursal">{{ __('E-mail *') }}</label></strong>
                        <input type="email" name="email_sucursal" value="{{ old('email_sucursal') }}"
                            placeholder="correo@ejemplo.com"
                            class="form-control @error('email_sucursal') is-invalid @enderror" required>

                        @error('email_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- TELEFONO -->
                    <div class="form-group">
                        <strong><label
                                for="telefono_sucursal">{{ __('Teléfono *') }}</label></strong>
                        <input type="text" name="telefono_sucursal"
                            value="{{ old('telefono_sucursal') }}" placeholder="Ejemplo: 29844586958"
                            class="form-control @error('telefono_sucursal') is-invalid @enderror" required>
                        <small class="form-text text-muted">Sin espacios ni guiones, 8 dígitos mínimo</small>

                        @error('telefono_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Direccion -->
                    <div class="form-group">
                        <strong><label
                                for="direccion_sucursal">{{ __('Dirección *') }}</label></strong>
                        <input type="text" name="direccion_sucursal"
                            value="{{ old('direccion_sucursal') }}"
                            placeholder="Ejemplo: Entre Av. Libertad y San Martin n° 154"
                            class="form-control @error('direccion_sucursal') is-invalid @enderror" required>
                        <small class="form-text text-muted">Calle y número</small>

                        @error('direccion_sucursal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong>
                            <label for="ubicacion_mapa">{{ __('Ubicacion Mapa:') }}</label>
                        </strong>
                        <p>
                            <a class="btn btn-success btn-sm" id="actMap" style="color: azure">Activar Mapa</a>
                            <a class="btn btn-danger btn-sm"  id="desMap" style="color: azure" disabled>Desactivar Mapa</a>
                        </p>
                        <div id="alertMap" class="alert alert-warning" role="alert">
                        </div>
                        <div id="map" class="bg-dark"></div>
                        <input type="hidden" id="lat" name="lat">
                        <input type="hidden" id="long" name="long">
                        <small class="form-text text-muted">Doble clic para marcar la ubicacion de su Sucursal</small>
                    </div>


                    <div class="form-group">
                        <div class="d-flex d-flex justify-content-left">
                            <small class="form-text text-muted">Los campos marcados con (*) son obligatorios</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-flex d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mr-1">
                                {{ __('Registrar') }}
                            </button>
                            <a href="{{ route('farmacia.index') }}"
                                class="btn btn-primary">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.ckeditor.com/4.15.1/basic/ckeditor.js"></script>
<script>
    CKEDITOR.replace('descripcion_sucursal');
</script>
@endsection
@section('zona_js')
<script>
    $(document).ready(function () {
        $('#alertMap').hide();
        var map = L.map('map').setView({
            lon: -67.8284165,
            lat: -38.9793436
        }, 15);
        // add the OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
        }).addTo(map);
        // show the scale bar on the lower left corner
        L.control.scale().addTo(map);
        map.dragging.disable();
        map.touchZoom.disable();
        map.doubleClickZoom.disable();
        map.scrollWheelZoom.disable();
        map.boxZoom.disable();
        map.keyboard.disable();
        if (map.tap) map.tap.disable();
        $('#map').css('cursor', 'default');
        $('#desMap').click(function () {
            $('#actMap').prop('disabled', true);
            $('#desMap').prop('disabled', false);
            $('#alertMap').text('El Mapa esta descativado ahora');
            $('#alertMap').show();
            map.dragging.disable();
            map.touchZoom.disable();
            map.doubleClickZoom.disable();
            map.scrollWheelZoom.disable();
            map.boxZoom.disable();
            map.keyboard.disable();
            if (map.tap) map.tap.disable();
            $('#map').css('cursor', 'default');
        })
        $('#actMap').click(function () {
            $('#actMap').prop('disabled', false);
            $('#desMap').prop('disabled', true);
            $('#alertMap').text('El Mapa esta activo ahora');
            $('#alertMap').show();
            map.dragging.enable();
            map.touchZoom.enable();
            map.scrollWheelZoom.enable();
            map.boxZoom.enable();
            map.keyboard.enable();
            if (map.tap) map.tap.enable();
            $('#map').css('cursor', 'grab');
        })
        // show a marker on the map
        var marcador = {};
        map.on('dblclick', e => {
            map.removeLayer(marcador);
            let latlng = map.mouseEventToLatLng(e.originalEvent);
            marcador = L.marker([latlng.lat, latlng.lng]);
            $('#lat').val(latlng.lat);
            $('#long').val(latlng.lng);
            marcador.addTo(map);
            // console.log($('#lat').val());	
            // console.log($('#long').val());	
        })
    })
</script>
@endsection