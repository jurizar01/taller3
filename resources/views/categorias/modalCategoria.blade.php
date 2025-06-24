<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCategoriaLabel">Agregar Nueva Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCrearCategoria" action="{{ route('categorias.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- CAMPO FALTANTE: DESCRIPCIÓN -->
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción *</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required
                            placeholder="Ingrese la descripción de la categoría">
                        @error('descripcion')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
