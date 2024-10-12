<?php

namespace App\Http\Controllers;

use App\Models\Pelis;
use Illuminate\Http\Request;

class PelisController extends Controller
{
    //Mostrar pelicula
    public function show($id)
{
    $peli = Pelis::findOrFail($id); // Busca la película por ID, lanzará un error 404 si no se encuentra
    return view('pelis.show', compact('peli')); // Retorna una vista con los detalles de la película
}

    // Mostrar todas las películas
    public function index()
    {
        $pelis = Pelis::all();
        return view('index', compact('pelis'));
    }

    // Guardar una nueva película
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'año' => 'required|integer|min:1900|max:' . date('Y'),
    ]);

    Pelis::create($request->only(['name', 'año']));
    
    // Redirigir de nuevo a la lista de películas con un mensaje de éxito
    return redirect()->route('pelis.index')->with('success', 'Película añadida correctamente.');
}

// Editar una película existente
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'año' => 'required|integer|min:1900|max:' . date('Y'),
    ]);

    $pelis = Pelis::findOrFail($id);
    $pelis->update($request->all());

    // Redirigir de nuevo a la lista de películas con un mensaje de éxito
    return redirect()->route('pelis.index')->with('success', 'Película actualizada correctamente.');
}


    // Eliminar una película
public function destroy($id)
{
    Pelis::findOrFail($id)->delete();

    // Redirigir de nuevo a la lista de películas con un mensaje de éxito
    return redirect()->route('pelis.index')->with('success', 'Película eliminada correctamente.');
}

}
