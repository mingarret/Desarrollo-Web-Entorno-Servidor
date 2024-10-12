@extends('layouts.app')

@section('content')
    @include('partials.navbar')

    <div class="producto-detalle">
        <h1>{{ is_object($producto) ? $producto->nombre : $producto['nombre'] }}</h1>
        <img src="{{ asset('images/' . (is_object($producto) ? $producto->imagen : $producto['imagen'])) }}" alt="{{ is_object($producto) ? $producto->nombre : $producto['nombre'] }}">
        <p>Precio: ${{ is_object($producto) ? $producto->precio : $producto['precio'] }}</p>
    </div>

    
@endsection
