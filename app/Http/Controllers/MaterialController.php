<?php
namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    // Obtener todos los materiales
    public function index() {
        return response()->json(Material::all());
    }

    // Registrar un nuevo material
    public function store(Request $request) {
        $request->validate([
            'clave_material' => 'required',
            'descripcion' => 'required',
            'generico' => 'nullable',
            'clasificacion' => 'nullable',
            'existencia' => 'required|integer',
            'costo_promedio' => 'required|numeric',
        ]);

        $material = Material::create($request->all());
        return response()->json(['message' => 'Material agregado', 'data' => $material], 201);
    }

    // Obtener un material por ID
    public function show($id) {
        $material = Material::findOrFail($id);
        return response()->json($material);
    }

    // Actualizar material
    public function update(Request $request, $id) {
        $material = Material::findOrFail($id);
        $material->update($request->all());
        return response()->json(['message' => 'Material actualizado', 'data' => $material]);
    }

    // Eliminar material
    public function destroy($id) {
        Material::findOrFail($id)->delete();
        return response()->json(['message' => 'Material eliminado']);
    }
}
