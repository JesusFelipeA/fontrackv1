<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MaterialController;

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// **Rutas de usuarios (CRUD)**
Route::get('/users', [UsuarioController::class, 'index'])->name('users'); // Listado de usuarios
Route::get('/users/{id}', [UsuarioController::class, 'show'])->name('user_detail'); // Ver usuario

// Modal para registrar usuario
Route::post('/register_user', [UsuarioController::class, 'store'])->name('register_user');

// Modal para editar usuario
Route::get('/edit_user/{id}', [UsuarioController::class, 'edit'])->name('edit_user'); // Cargar datos para edición
Route::put('/update_user/{id}', [UsuarioController::class, 'update'])->name('update_user'); // Guardar cambios

// Modal para eliminar usuario
Route::delete('/delete_user/{id}', [UsuarioController::class, 'destroy'])->name('delete_user');

// **Rutas de materiales (CRUD)**
Route::get('/materials', [MaterialController::class, 'index'])->name('materials');
Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('material_detail');
Route::post('/materials', [MaterialController::class, 'store'])->name('register_material');
Route::get('/edit_material/{id}', [MaterialController::class, 'edit'])->name('edit_material');
Route::put('/update_material/{id}', [MaterialController::class, 'update'])->name('update_material');
Route::delete('/delete_material/{id}', [MaterialController::class, 'destroy'])->name('delete_material');

// **Rutas protegidas solo para admins**
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// **AJAX para funcionamiento de los modales**
Route::get('/modal/user/{id}', [UsuarioController::class, 'show'])->name('modal_show_user'); // Ver usuario en modal
Route::get('/modal/edit_user/{id}', [UsuarioController::class, 'edit'])->name('modal_edit_user'); // Cargar usuario en modal
Route::post('/modal/register_user', [UsuarioController::class, 'store'])->name('modal_register_user'); // Registrar desde modal
Route::put('/modal/update_user/{id}', [UsuarioController::class, 'update'])->name('modal_update_user'); // Editar desde modal
Route::delete('/modal/delete_user/{id}', [UsuarioController::class, 'destroy'])->name('modal_delete_user'); // Eliminar desde modal