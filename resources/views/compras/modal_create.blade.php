<!-- Modal -->
<div class="modal fade" id="modalCompra" tabindex="-1" aria-labelledby="modalCompraLabel"aria-hidden="true">

    <div class="modal-dialog">

        <form method="POST" action="{{ route('compras.store') }}">

            @csrf

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="modalCompraLabel">Nueva Compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">

                    {{-- <div class="mb-3">
                        <label for="cliente_id" class="form-label">Cliente_id</label>
                        <input type="text" class="form-control" id="cliente_id" name="cliente_id" required>

                    </div> --}}



                    <div class="form-group">
                        <label for="cliente_id">Cliente</label>
                        <select name="cliente_id" class="form-control" required>
                            <option value="">-- Selecciona un cliente --</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="text" class="form-control" id="fecha" name="fecha" required>

                    </div>

                    <div class="mb-3">
                        <label for="medio_pago" class="form-label">Medio_pago</label>
                        <input type="text" class="form-control" id="medio_pago" name="medio_pago" required>

                    </div>


                    <div class="mb-3">
                        <label for="comentario class="form-label">Comentario</label>
                        <input type="text" class="form-control" id="comentario" name="comentario" required>

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
