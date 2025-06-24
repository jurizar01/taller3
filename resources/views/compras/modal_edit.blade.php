
<!-- Modal Editar Compra -->
<div class="modal fade" id="modalEditarCompra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditarCompra" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Editar Compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="form-group mb-3">
                        <label class="form-label">Cliente</label>
                        <select name="cliente_id" id="edit_cliente_id" class="form-select" required>
                            <option value="">-- Selecciona cliente --</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="edit_fecha" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Medio de pago</label>
                        <select name="medio_pago" id="edit_medio_pago" class="form-select" required>
                            <option value="efectivo">Efectivo</option>
                            <option value="tarjeta">Tarjeta</option>
                            <option value="transferencia">Transferencia</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Comentario</label>
                        <textarea name="comentario" id="edit_comentario" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
