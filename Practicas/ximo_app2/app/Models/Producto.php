<?php
namespace App\Models;

class Producto
{
    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $imagen;

    public function __construct($id, $nombre, $descripcion, $precio, $imagen)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->imagen = $imagen;
    }
}
