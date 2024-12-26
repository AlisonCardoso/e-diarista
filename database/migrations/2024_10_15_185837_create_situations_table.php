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
        Schema::create('situations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ex: 'pending', 'approved', 'rejected'
            $table->string('color')->nullable();
            $table->string('description')->nullable(); // Descrição opcional da situação        
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('situations');
    }
};
