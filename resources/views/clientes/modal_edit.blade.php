<!-- Modal Editar Cliente -->
<div class="modal fade" id="modalEditarCliente" tabindex="-1" aria-labelledby="modalEditarClienteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formEditarCliente" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modalEditarClienteLabel">Editar Cliente</h5>
                    <!-- Botón de cerrar CORREGIDO -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Campos del formulario -->
                    <input type="hidden" name="id" id="edit_id">

                    <div class="form-group">
                        <label for="edit_dni">DNI</label>
                        <input type="text" name="dni" id="edit_dni" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_nombre">Nombre</label>
                        <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_apellidos">Apellido</label>
                        <input type="text" name="apellidos" id="edit_apellidos" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_celular">Celular</label>
                        <input type="text" name="celular" id="edit_celular" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_direccion">Direccion</label>
                        <input type="text" name="direccion" id="edit_direccion" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_correo_electronico">Correo Electronico</label>
                        <input type="text" name="correo_electronico" id="edit_correo_electronico" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Botón Cancelar CORREGIDO -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
                </div>
            </div>
        </form>
    </div>
</div>
