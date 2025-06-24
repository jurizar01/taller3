<!-- Modal -->
<div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modalClienteLabel"aria-hidden="true">

    <div class="modal-dialog">

        <form method="POST" action="{{ route('clientes.store') }}">

            @csrf

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="modalClienteLabel">Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" class="form-control" id="dni" name="dni" required>

                    </div>


                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>

                    </div>


                        <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>

                    </div>



                    <div class="mb-3">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="celular" name="celular" required>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion"
                            required>
                    </div>


                    <div class="mb-3">
                        <label for="correo_electronico" class="form-label">Correo Electronico</label>
                        <input type="text" class="form-control" id="correo_electronico" name="correo_electronico" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                </div>
            </div>
        </form>
    </div>
</div>
