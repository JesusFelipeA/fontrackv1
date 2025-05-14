<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'tb_materiales'; // Nombre de la tabla
    protected $fillable = [
        'clave_material', 'descripcion', 'generico', 
        'clasificacion', 'existencia', 'costo_promedio'
    ]; 
}
