<?php
use App\Models\tb_materiales;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tb_materiales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clave_material');
            $table->text('descripcion');
            $table->string('generico')->nullable();
            $table->string('clasificacion')->nullable();
            $table->integer('existencia')->default(0);
            $table->decimal('costo_promedio', 10, 2);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('tb_materiales');
    }
};