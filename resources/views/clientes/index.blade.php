@extends('adminlte::page')
@section('title', 'Clientes')
@section('content_header')
    <h1>Lista de Clientes</h1>
    </br>
    <div class ="card-header">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCliente">
            Agregar Cliente
        </button>
    </div>
@stop

@section('content')
    <table id="clientes-table" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Dni</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Celular</th>
                <th>Correo_electronico</th>
                <th>Direccion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr id="fila_cliente_{{ $cliente->id }}">

                <td class="dni">{{ $cliente->dni }}</td>
                   <td class="nombre">{{ $cliente->nombre }}</td>
                    <td class="apellidos">{{ $cliente->apellidos}}</td>

                    <td class="celular">{{$cliente->celular }}</td>

                    <td class="correo_electronico">{{$cliente->correo_electronico}}</td>

                    <td class="direccion">{{ $cliente->direccion }}</td>


                    <td class="text-center">

                        <button type="button" class="btn btn-warning btn-sm"
                            onclick="cargarDatosEditar({{ $cliente->id }})">
                            <i class="fas fa-pencil-alt"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="eliminarCliente({{ $cliente->id }})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('clientes.modalCliente')
    @include('clientes.modal_edit')
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
            $('#clientes-table').DataTable();
        });

        function cargarDatosEditar(id) {
            $('#formEditarCliente').attr('action', `/clientes/${id}`);
            $.ajax({
                url: `/clientes_llenar/${id}`,
                type: 'GET',
                success: function(data) {
                    $('#edit_id').val(data.id);
                    $('#edit_dni').val(data.dni);
                    $('#edit_nombre').val(data.nombre);
                    $('#edit_apellidos').val(data.apellidos);
                    $('#edit_celular').val(data.celular);

                    $('#edit_direccion').val(data.direccion);
$('#edit_correo_electronico').val(data.correo_electronico);
                    $('#modalEditarCliente').modal('show');
                },
                error: function(xhr) {
                    Swal.fire('Error', 'No se pudo cargar cliente.', 'error');
                }
            });
        }



        function eliminarCliente(id) {
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
                        url: `/clientes/${id}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $(`#fila_cliente_${id}`).remove();
                            Swal.fire('¡Eliminado!', 'El cliente ha sido eliminada.', 'success');
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'No se pudo eliminar al cliente', 'error');
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            $('#formEditarCliente').on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit_id').val();
                const url = `/clientes/${id}`;
                const datos = {
                    _token: $('input[name="_token"]').val(),
                    _method: 'PUT',
                    dni: $('#edit_dni').val(),
                    nombre: $('#edit_nombre').val(),
                    apellidos: $('#edit_apellidos').val(),
                    celular: $('#edit_celular').val(),

                    direccion: $('#edit_direccion').val(),
                    correo_electronico: $('#edit_correo_electronico').val(),

                };

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: datos,
                    success: function(response) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'modalEditarCliente'));
                        modal.hide();
                        Swal.fire('Éxito', response.message, 'success');

                        const fila = $(`#fila_cliente_${id}`);
                        fila.find('.dni').text($('#edit_dni').val());
                        fila.find('.nombre').text($('#edit_nombre').val());
                        fila.find('.apellidos').text($('#edit_apellidos').val());
                        fila.find('.celular').text($('#edit_celular').val());
                        fila.find('.direccion').text($('#edit_direccion').val());
                        fila.find('.correo_electronico').text($('#edit_correo_electronico').val());
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'No se pudo actualizar al cliente.', 'error');
                    }
                });
            });
        });
    </script>
@stop
