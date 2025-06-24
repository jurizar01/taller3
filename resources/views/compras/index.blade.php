@extends('adminlte::page')
@section('title', 'Compras')
@section('content_header')
    <h1>Lista de Compras</h1>
    <div class="card-header">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCompra">
            Agregar Compra
        </button>
    </div>
@stop

@section('content')
    <table id="compras-table" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Cliente</th> <!-- Cambiado de Cliente_id a Cliente -->
                <th>Fecha</th>
                <th>Medio_pago</th>
                <th>Comentario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $compra)
                <tr id="fila_compra_{{ $compra->id }}">
                    <!-- Mostrar nombre del cliente en lugar del ID -->
                    <td class="cliente_id">{{ $compra->cliente->nombre ?? 'Sin cliente' }}</td>
                    <td class="fecha">{{ $compra->fecha}}</td>
                    <td class="medio_pago">{{ $compra->medio_pago }}</td>
                    <td class="comentario">{{ $compra->comentario }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-warning btn-sm"
                            onclick="cargarDatosEditar({{ $compra->id }})">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="eliminarCompra({{ $compra->id }})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('compras.modalCompra')
    @include('compras.modal_edit')
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
            $('#compras-table').DataTable();
        });

        function cargarDatosEditar(id) {
            $('#formEditarCompra').attr('action', `/compras/${id}`);
            $.ajax({
                url: `/compras_llenar/${id}`,
                type: 'GET',
                success: function(data) {
                    $('#edit_id').val(data.id);
                    $('#edit_cliente_id').val(data.cliente_id);
                    $('#edit_fecha').val(data.fecha);
                    $('#edit_medio_pago').val(data.medio_pago);
                    $('#edit_comentario').val(data.comentario);
                    $('#modalEditarCompra').modal('show'); // Corregido el ID del modal
                },
                error: function(xhr) {
                    Swal.fire('Error', 'No se pudo cargar la compra.', 'error');
                }
            });
        }

        function eliminarCompra(id) {
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
                        url: `/compras/${id}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $(`#fila_compra_${id}`).remove();
                            Swal.fire('¡Eliminado!', 'La compra ha sido eliminada.', 'success');
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'No se pudo eliminar la compra', 'error');
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            $('#formEditarCompra').on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit_id').val();
                const url = `/compras/${id}`;
                const datos = {
                    _token: $('input[name="_token"]').val(),
                    _method: 'PUT',
                    cliente_id: $('#edit_cliente_id').val(),
                    fecha: $('#edit_fecha').val(),
                    medio_pago: $('#edit_medio_pago').val(),
                    comentario: $('#edit_comentario').val(),
                };

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: datos,
                    success: function(response) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarCompra'));
                        modal.hide();
                        Swal.fire('Éxito', response.message, 'success');

                        // Actualizar la fila con los nuevos datos
                        const fila = $(`#fila_compra_${id}`);
                        // Actualizar el nombre del cliente usando el ID seleccionado
                        const clienteNombre = $('#edit_cliente_id option:selected').text();
                        fila.find('.cliente_id').text(clienteNombre);
                        fila.find('.fecha').text($('#edit_fecha').val());
                        fila.find('.medio_pago').text($('#edit_medio_pago').val());
                        fila.find('.comentario').text($('#edit_comentario').val());
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'No se pudo actualizar la compra.', 'error');
                    }
                });
            });
        });
    </script>
@stop
