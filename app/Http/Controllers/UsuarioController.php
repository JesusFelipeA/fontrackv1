<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // Método para mostrar la lista de usuarios con paginación
    public function index()
    {
        $usuarios = Usuarios::paginate(10); // Mostrará 10 usuarios por página
        return view('index', compact('usuarios'));
    }

    // Método para almacenar un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:tb_users,correo|max:255',
            'password' => 'required|min:6',
            'tipo_usuario' => 'required|integer',
        ]);

        $usuario = Usuarios::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'tipo_usuario' => $request->tipo_usuario,
        ]);

        return response()->json(['message' => 'Usuario registrado correctamente', 'data' => $usuario], 201);
    }

    // Método para mostrar un usuario específico
    public function show($id)
    {
        $usuario = Usuarios::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json(['data' => $usuario]);
    }

    // Método para obtener datos de un usuario y editarlos
    public function edit($id)
    {
        $usuario = Usuarios::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json(['data' => $usuario]);
    }

    // Método para actualizar un usuario
    public function update(Request $request, $id)
    {
        $usuario = Usuarios::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'correo' => 'sometimes|required|email|unique:tb_users,correo,' . $id . ',id_usuario|max:255',
            'password' => 'nullable|min:6',
            'tipo_usuario' => 'sometimes|required|integer',
        ]);

        $usuario->update($request->except(['password']));

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
            $usuario->save();
        }

        return response()->json(['message' => 'Usuario actualizado correctamente', 'data' => $usuario]);
    }

    // Método para eliminar un usuario
    public function destroy($id)
    {
        $usuario = Usuarios::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}
