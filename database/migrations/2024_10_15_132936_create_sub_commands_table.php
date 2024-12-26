<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\softDeletes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_commands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('regional_command_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('slug')->unique(); // Definir como único, se necessário
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_commands');
    }
};
