@extends('adminlte::page')

@section('title', 'Hola Mundo')

@section('content_header')
    <h1>cabecera de la Vista</h1>
@stop

@section('content')
    <p>¡Hola mundo desde Laravel*****¡</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
