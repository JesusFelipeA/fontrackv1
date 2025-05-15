<?php
namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    // Obtener todos los usuarios
    public function index() {
        $users = Usuarios::all(); // Aquí debe ser el modelo User, no el controlador
        return view('index', compact('users')); // Debe coincidir con el nombre de la vista
    }

    // Registrar un nuevo usuario
    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required',
            'password' => 'required|min:6',
            'tipo_usuario' => 'required|integer',
            'foto_usuario' => 'nullable|string',
        ]);

        $user = Usuarios::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'tipo_usuario' => $request->tipo_usuario,
            'foto_usuario' => $request->foto_usuario,
        ]);

        return response()->json(['message' => 'Usuario registrado correctamente', 'data' => $user], 201);
    }

    // Obtener un usuario por ID
    public function show($id) {
        return response()->json(Usuarios::findOrFail($id));
    }

    // Actualizar usuario
    public function update(Request $request, $id) {
        $user = Usuarios::findOrFail($id);
        $user->update($request->only(['nombre', 'correo', 'tipo_usuario', 'foto_usuario']));
        return response()->json(['message' => 'Usuario actualizado', 'data' => $user]);
    }

    // Eliminar usuario
    public function destroy($id) {
        Usuarios::findOrFail($id)->delete();
        return response()->json(['message' => 'Usuario eliminado']);
    }
}
