<!-- Modal Editar Categoria -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="modalEditarCategoriaLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formEditarCategoria" method="POST">
            @csrf
            @method('PUT') <!-- Importante para que Laravel lo reconozca como PUT -->
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modalEditarCategoriaLabel">Editar Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Campos del formulario -->
                    <input type="hidden" name="id" id="edit_id">

                    <div class="form-group">
                        <label for="edit_descripcion">Descripcion</label>
                        <input type="text" name="descripcion" id="edit_descripcion" class="form-control" required>
                    </div>
                </div> <!-- Este div cierra modal-body correctamente -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Categoria</button> <!-- Corregido btnprimary a btn-primary -->
                </div>
            </div>
        </form>
    </div>
</div>
