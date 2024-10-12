<div class="catalogo">
    @foreach($productos as $producto)
        <div class="producto">
            <img src="{{ asset('images/' . (is_object($producto) ? $producto->imagen : $producto['imagen'])) }}" alt="{{ is_object($producto) ? $producto->nombre : $producto['nombre'] }}">
            <h3>{{ is_object($producto) ? $producto->nombre : $producto['nombre'] }}</h3>
            <p>{{ is_object($producto) ? $producto->descripcion : $producto['descripcion'] }}</p>
            <p>Precio: ${{ is_object($producto) ? $producto->precio : $producto['precio'] }}</p>
            <a href="/producto/{{ is_object($producto) ? $producto->id : $producto['id'] }}">Ver Producto</a>
        </div>
    @endforeach
</div>
