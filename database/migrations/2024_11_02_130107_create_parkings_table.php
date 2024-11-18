<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del parqueadero
            $table->string('legal_representative'); // Representante legal
            $table->text('address'); // Dirección
            $table->boolean('is_covered'); // Si está cubierto
            $table->integer('levels'); // Número de niveles
            $table->json('spaces'); // Espacios por nivel (JSON)
            $table->text('image'); // Ruta de la imagen
            $table->integer('total_cars'); // Total de carros
            $table->integer('total_bikes'); // Total de motos
            $table->integer('total_combined'); // Total combinado
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkings');
    }
};
