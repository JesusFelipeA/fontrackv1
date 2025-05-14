<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MaterialController;

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas de usuarios (CRUD)
Route::name('users')->get('/users', [UsuarioController::class, 'index']);
Route::name('user_detail')->get('/users/{id}', [UsuarioController::class, 'show']);
Route::name('register_user')->post('/register_user', [UsuarioController::class, 'store']);
Route::name('edit_user')->get('/edit_user/{id}', [UsuarioController::class, 'update']);
Route::name('update_user')->put('/update_user/{id}', [UsuarioController::class, 'update']);
Route::delete('/delete_user/{id}', [UsuarioController::class, 'destroy'])->name('delete_user');

// Rutas de materiales (CRUD)
Route::name('materials')->get('/materials', [MaterialController::class, 'index']);
Route::name('material_detail')->get('/materials/{id}', [MaterialController::class, 'show']);
Route::name('register_material')->post('/materials', [MaterialController::class, 'store']);
Route::name('edit_material')->get('/edit_material/{id}', [MaterialController::class, 'update']);
Route::name('update_material')->put('/update_material/{id}', [MaterialController::class, 'update']);
Route::delete('/delete_material/{id}', [MaterialController::class, 'destroy'])->name('delete_material');

// Ruta protegida solo para admins
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
