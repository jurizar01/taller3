@extends('adminlte::page')
@section('title','lista de Usuarios')
@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop
@section('content')
    <table>
        <tr>
                <th>Nombre</th>
                <th>Correo</th>
            </tr>
            @foreach ($usuarios as $usuario)
                <tr>

                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->email}}</td>
                </tr>

            @endforeach
        </tbody>
    </table>
@stop

@section('css')


@stop

@section('js')

@stop
