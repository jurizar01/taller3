<!-- Modal -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="modalProductoLabel"aria-hidden="true">

    <div class="modal-dialog">

        <form method="POST" action="{{ route('productos.store') }}">

            @csrf

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="modalProductoLabel">Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>

                    </div>

                    <div class="form-group">
                        <label for="categoria_id">Categoria</label>
                        <select name="categoria_id" class="form-control" required>
                            <option value="">-- Selecciona una categoria --</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="codigo_barras" class="form-label">Codigo de Barras</label>
                        <input type="text" class="form-control" id="codigo_barras" name="codigo_barras" required>
                    </div>

                    <div class="mb-3">
                        <label for="precio_venta" class="form-label">Precio de Venta</label>
                        <input type="number" step="0.01" class="form-control" id="precio_venta" name="precio_venta"
                            required>
                    </div>


                    <div class="mb-3">
                        <label for="cantidad_stock" class="form-label">Cantidad en Stock</label>
                        <input type="number" class="form-control" id="cantidad_stock" name="cantidad_stock" required>
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
