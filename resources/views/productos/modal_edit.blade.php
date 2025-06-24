<!-- Modal Editar Producto -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formEditarProducto" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modalEditarProductoLabel">Editar Producto</h5>
                    <!-- Botón de cerrar corregido para Bootstrap 5 -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Campos del formulario -->
                    <input type="hidden" name="id" id="edit_id">

                    <div class="form-group">
                        <label for="edit_nombre">Nombre</label>
                        <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_categoria_id">Categoría</label>
                        <select name="categoria_id" id="edit_categoria_id" class="form-control" required>
                            <option value="">-- Selecciona una categoría --</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_codigo_barras">Código de Barras</label>
                        <input type="text" name="codigo_barras" id="edit_codigo_barras" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="edit_precio_venta">Precio de Venta</label>
                        <input type="number" name="precio_venta" id="edit_precio_venta" step="0.01"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_cantidad_stock">Cantidad en Stock</label>
                        <input type="number" name="cantidad_stock" id="edit_cantidad_stock" class="form-control"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Botón Cancelar corregido para Bootstrap 5 -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <!-- Corregido: btn btnprimary -> btn btn-primary -->
                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                </div>
            </div>
        </form>
    </div>
</div>
