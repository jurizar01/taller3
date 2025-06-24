@extends('adminlte::page')
@section('title', 'Categorias')
@section('content_header')
    <h1>Lista de Categorias</h1>
    </br>
    <div class ="card-header">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCategoria">
            Agregar Categoria
        </button>
    </div>
@stop

@section('content')
    <table id="categorias-table" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr id="fila_categoria_{{ $categoria->id }}">
                    <!-- CELDA AGREGADA -->
                    <td class="descripcion">{{ $categoria->descripcion }}</td>

                    <td class="text-center">
                        <button type="button" class="btn btn-warning btn-sm"
                            onclick="cargarDatosEditar({{ $categoria->id }})">
                            <i class="fas fa-pencil-alt"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="eliminarCategoria({{ $categoria->id }})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('categorias.modalCategoria')
    @include('categorias.modal_edit')
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
            $('#categorias-table').DataTable();
        });

        function cargarDatosEditar(id) {
            $('#formEditarCategoria').attr('action', `/categorias/${id}`);
            $.ajax({
                url: `/categorias_llenar/${id}`,
                type: 'GET',
                success: function(data) {
                    $('#edit_id').val(data.id);
                    $('#edit_descripcion').val(data.descripcion);

                    $('#modalEditarCategoria').modal('show');
                },
                error: function(xhr) {
                    Swal.fire('Error', 'No se pudo cargar la categoria.', 'error');
                }
            });
        }

        // function eliminarCategoria(id) {
        //     Swal.fire({
        //         title: '¿Estás seguro?',
        //         text: "¡No podrás revertir esta acción!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#d33',
        //         cancelButtonColor: '#3085d6',
        //         confirmButtonText: 'Sí, eliminar',
        //         cancelButtonText: 'Cancelar'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 url: `/categorias/${id}`,
        //                 type: 'DELETE',
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 },
        //                 success: function(response) {
        //                     $(`#fila_categoria_${id}`).remove();
        //                     Swal.fire('¡Eliminado!', 'La categoria ha sido eliminado.', 'success');
        //                 },
        //                 error: function(xhr) {
        //                     Swal.fire('Error', 'No se pudo eliminar la categoria', 'error');
        //                 }
        //             });
        //         }
        //     });
        // }


function eliminarCategoria(id) {
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
                url: `/categorias/${id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $(`#fila_categoria_${id}`).remove();
                            Swal.fire('¡Eliminado!', 'La categoria ha sido eliminada.', 'success');
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'No se pudo eliminar la categoria', 'error');
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            $('#formEditarCategoria').on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit_id').val();
                const url = `/categorias/${id}`;
                const datos = {
                    _token: $('input[name="_token"]').val(),
                    _method: 'PUT',
                    descripcion: $('#edit_descripcion').val()

                };

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: datos,
                    success: function(response) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarCategoria'));
                        modal.hide();
                        Swal.fire('Éxito', response.message, 'success');

                        const fila = $(`#fila_categoria_${id}`);
                        fila.find('.descripcion').text($('#edit_descripcion').val());

                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'No se pudo actualizar la categoria.', 'error');
                    }
                });
            });
        });
    </script>
@stop

