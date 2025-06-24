<!-- Modal -->
<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel"aria-hidden="true">

    <div class="modal-dialog">

        <form method="POST" action="{{ route('categorias.store') }}">

            @csrf

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="modalCategoriaLabel">Nueva Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>

                    </div>

                    <div class="form-group">



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                </div>
            </div>
        </form>
    </div>
</div>
