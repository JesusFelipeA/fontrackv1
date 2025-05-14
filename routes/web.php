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
Route::get('/users', [UsuarioController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UsuarioController::class, 'show'])->name('users.show');
Route::post('/users', [UsuarioController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [UsuarioController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UsuarioController::class, 'destroy'])->name('users.destroy');

// Rutas de materiales (CRUD)
Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('materials.show');
Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
Route::put('/materials/{id}', [MaterialController::class, 'update'])->name('materials.update');
Route::delete('/materials/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy');

// Ruta protegida solo para admins
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
