<?php

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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_command_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('type_vehicle_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('situation_vehicle_id')->default(1)->constrained()->cascadeOnUpdate(); // Garantir integridade
            $table->string('brand'); // Marca
            $table->string('model'); // Modelo
            $table->string('prefix')->unique(); // Prefixo único
            $table->boolean('characterized')->default(1); // Veículo caracterizado
            $table->string('asset_number')->unique()->nullable(); // Número de patrimônio (opcional)
            $table->string('odometer')->nullable(); // Hodômetro
            $table->string('plate')->unique(); // Placa única
            $table->year('year'); // Ano de fabricação
            $table->decimal('price', 8, 2); // Preço
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
