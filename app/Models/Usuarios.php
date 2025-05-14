<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_users'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nombre',
        'correo',
        'password',
        'tipo_usuario',
        'foto_usuario'
    ];

    protected $hidden = ['password']; // Oculta la contraseña en las respuestas JSON

    public $timestamps = true; // Activa timestamps si la tabla tiene created_at y updated_at
}
