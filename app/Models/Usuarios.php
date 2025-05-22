<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_users'; 

    protected $primaryKey = 'id_usuario'; 

    protected $fillable = [
        'nombre',
        'correo',
        'password',
        'tipo_usuario',
        'foto_usuario'
    ];

    protected $hidden = ['password']; 

    public $timestamps = true; 
}