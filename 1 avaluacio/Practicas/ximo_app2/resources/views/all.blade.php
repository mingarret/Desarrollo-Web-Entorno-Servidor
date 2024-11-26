@extends('layouts.app')

@section('content')
    @include('partials.navbar')

    <h1>Todos los Catálogos</h1>

    <h2>Ofertas</h2>
    @include('partials.catalogo', ['productos' => $ofertas])

    <h2>Selección</h2>
    @include('partials.catalogo', ['productos' => $seleccion])

    <h2>Top Ventas</h2>
    @include('partials.catalogo', ['productos' => $topventas])

@endsection
