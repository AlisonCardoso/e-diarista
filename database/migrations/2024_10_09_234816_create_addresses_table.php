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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workshop_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); 
            $table->string('cep');
            $table->string('state');
            $table->string('city');
            $table->string('neighborhood');
            $table->string('street');
            $table->integer('number')->nullable();
            $table->string('complement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
