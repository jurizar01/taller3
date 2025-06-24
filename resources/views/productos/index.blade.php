@extends('adminlte::page')
@section('title', 'Productos')
@section('content_header')
    <h1>Lista de Productos</h1>
    <div class="card-header">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalProducto">
            Agregar Producto
        </button>
    </div>
@stop

@section('content')
    <table id="productos-table" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Codigo_barras</th>
                <th>Precio_ventas</th>
                <th>Cantidad_stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr id="fila_producto_{{ $producto->id }}">

                    <td class="nombre">{{ $producto->nombre }}</td>

                    <td class="codigo_barras">{{
                    $producto->codigo_barras }}</td>
                    <td class="precio_venta">{{ number_format($producto->precio_venta, 2) }}</td>
                    <td class="cantidad_stock">{{ $producto->cantidad_stock }}</td>



                    <td class="text-center">
                        <button type="button" class="btn btn-warning btn-sm"
                            onclick="cargarDatosEditar({{ $producto->id }})">
                            <i class="fas fa-pencil-alt"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="eliminarProducto({{ $producto->id }})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('productos.modalProducto')
    @include('productos.modal_edit')
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "{{ session('success') }}",
                    icon: "success"
                });
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#productos-table').DataTable();
        });

        function cargarDatosEditar(id) {
            $('#formEditarProducto').attr('action', `/productos/${id}`);
            $.ajax({
                url: `/productos_llenar/${id}`,
                type: 'GET',
                success: function(data) {
                    $('#edit_id').val(data.id);
                    $('#edit_nombre').val(data.nombre);
                    $('#edit_categoria_id').val(data.categoria_id);
                    $('#edit_codigo_barras').val(data.codigo_barras);
                    $('#edit_precio_venta').val(data.precio_venta);
                    $('#edit_cantidad_stock').val(data.cantidad_stock);
                    $('#modalEditarProducto').modal('show');
                },
                error: function(xhr) {
                    Swal.fire('Error', 'No se pudo cargar el producto.', 'error');
                }
            });
        }

        function eliminarProducto(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/productos/${id}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $(`#fila_producto_${id}`).remove();
                            Swal.fire('¡Eliminado!', 'El producto ha sido eliminado.', 'success');
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'No se pudo eliminar el producto', 'error');
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            $('#formEditarProducto').on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit_id').val();
                const url = `/productos/${id}`;
                const datos = {
                    _token: $('input[name="_token"]').val(),
                    _method: 'PUT',
                    nombre: $('#edit_nombre').val(),
                    categoria_id: $('#edit_categoria_id').val(),
                    codigo_barras: $('#edit_codigo_barras').val(),
                    precio_venta: $('#edit_precio_venta').val(),
                    cantidad_stock: $('#edit_cantidad_stock').val()
                };

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: datos,
                    success: function(response) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarProducto'));
                        modal.hide();
                        Swal.fire('Éxito', response.message, 'success');

                        const fila = $(`#fila_producto_${id}`);
                        fila.find('.nombre').text($('#edit_nombre').val());
                        fila.find('.codigo_barras').text($('#edit_codigo_barras').val());
                        fila.find('.precio_venta').text(parseFloat($('#edit_precio_venta').val()).toFixed(2));
                        fila.find('.cantidad_stock').text($('#edit_cantidad_stock').val());
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'No se pudo actualizar el producto.', 'error');
                    }
                });
            });
        });
    </script>
@stop
