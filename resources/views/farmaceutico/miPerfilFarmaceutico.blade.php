@extends('welcome')
@section('titulo', 'Home')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-10 shadow bg-white mx-auto">
                @canany(['esFarmaceutico','esRegistrado'])
                <div class="row">
                    <div class="col-12 bg-encabezado mb-3 p-2">
                        <h2 class="text-center text-white"> MI PERFIL</h2>

                    </div>
                    <div Class="col-lg-7 col-12">
                        <div class="text ml-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Nombre: <span class="font-weight-bold text-secondary">
                                        {{ $usuarioFarmaceutico->nombre }}</span></li>
                                <li class="list-group-item">Apellido: <span class="font-weight-bold text-secondary">
                                        {{ $usuarioFarmaceutico->apellido }}</span></li>
                                <li class="list-group-item">Nombre de usuario: <span
                                        class="font-weight-bold text-secondary">
                                        {{ $usuarioFarmaceutico->nombre_usuario }}</span></li>
                                <li class="list-group-item">E-mail: <span class="font-weight-bold text-secondary">
                                        {{ $usuarioFarmaceutico->email }}</span></li>
                                <li class="list-group-item">Telefono: <span class="font-weight-bold text-secondary">
                                        {{ $usuarioFarmaceutico->telefono_movil }}</span></li>
                                <li class="list-group-item">Localidad: <span class="font-weight-bold text-secondary">
                                        {{ $usuarioFarmaceutico->localidad->nombre_localidad }}</span></li>
                                @can('esFarmaceutico')
                                    <li class="list-group-item">Cuil: <span class="font-weight-bold text-secondary">
                                            {{ $usuarioFarmaceutico->cuit }}</span></li>
                                    <li class="list-group-item">Cuit: <span class="font-weight-bold text-secondary">
                                            {{ $usuarioFarmaceutico->cuit }}</span></li>
                                    <li class="list-group-item">Número de matricula: <span
                                            class="font-weight-bold text-secondary">{{ $usuarioFarmaceutico->numero_matricula }}
                                        </span></li>
                                @endcan
                                <li class="list-group-item"><span class="font-weight-bold text-secondary"> </span></li>
                            </ul>
                        </div>
                    </div>
                    <div Class="col-lg-4 col-12 mt-4 mx-auto">
                        <div class="d-flex justify-content-center">
                            <img id="imgprev" class="card-img-top shadow img-thumbnail rounded-circle"
                                src="{{ asset($usuarioFarmaceutico->img_perfil) }}" alt="Imagen de perfil avatar"
                                width="300" height="300">
                        </div>
                        <div class="col-12 ">
                            <div class="d-flex justify-content-center">
                                {{-- @yield('subir_foto')
                                <!-- Section for upload image form --> --}}
                                <form method="POST"
                                    action="{{ route('cargarFotoPerfil', [$usuarioFarmaceutico->id_usuario]) }}"
                                    enctype="multipart/form-data">
                                    @method('patch')
                                    @csrf
                                    <!-- IMG farmacia -->
                                    <div class="form-group">
                                        <strong><label for="img_ferfil_form">{{ __('Suba una imagen *') }}</label></strong>

                                        <input id="file" type="file" name="img_ferfil_form" accept="image/*"
                                            class="form-control @error('img_ferfil_form')  is-invalid @enderror">

                                        <small class="form-text text-muted">Tamaño máximo 4MB </small>
                                        <small class="form-text text-muted">formato PNG, JPG y JPEG</small>

                                        @error('img_ferfil_form')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary mx-1">Subir</button>
                                            <a href="{{ route('miPerfilFarmacuetico') }}"
                                                class="btn btn-primary mx-1">Cancelar</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <div class="p-2">
                            <a href="{{ route('editarPerfil') }}"><i class="material-icons" style="font-size: 40px"
                                    data-toggle="tooltip" data-placement="left" title="Editar datos">edit</i></a>
                        </div>
                        <div class="p-2">
                            <a href="" title="Eliminar cuenta de usuario" data-toggle="modal" data-target="#deleteModal"
                                data-roleid="{{ $usuarioFarmaceutico->id_usuario }}"><i class="material-icons"
                                    style="font-size: 40px" data-placement="left">delete</i></a>
                        </div>
                    </div>
                </div>
                @endcanany
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Esta seguro que desea dar de Baja su Cuenta?</h5>
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
        document.getElementById("file").onchange = function(e) {
            // Creamos el objeto de la clase FileReader
            console.log("chau");
            let reader = new FileReader();

            // Leemos el archivo subido y se lo pasamos a nuestro fileReader
            reader.readAsDataURL(e.target.files[0]);

            // Le decimos que cuando este listo ejecute el código interno
            reader.onload = function() {
                // let preview = document.getElementById('preview'),

                image = $("#imgprev");
                image.src = reader.result;
                $("#imgprev").attr("src", image.src);


            };
        }

    </script>
    <script>
        $('#deleteModal').on('show.bs.modal', function(event) {
            var boton = $(event.relatedTarget);
            var id_usuario = boton.data('roleid');

            var modal = $(this);
            //modal.find('.modal-footer #id_rol').val(id_rol);
            //revisar o buscar otra forma
            modal.find('form').attr('action', 'darDeBajaCuenta/' + id_usuario);
        });

    </script>
@endsection
