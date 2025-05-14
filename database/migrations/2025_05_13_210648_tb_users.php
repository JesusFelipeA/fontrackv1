<?php

use App\Models\Usuarios;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_users', function(Blueprint $table){
            $table->bigIncrements('id_usuario');
            $table->string('nombre',255);
            $table->string('correo', 255);
            $table->string('password', 255);
            $table->integer('tipo_usuario');
            $table->string('foto_usuario', )->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_users');
    }
};
