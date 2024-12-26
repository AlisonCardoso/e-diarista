<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
           $table->string('cnpj')->unique()->nullable();
            $table->string('razao_social')->nullable();
            $table->string('descricao_situacao_cadastral')->nullable();
            $table->string('cnae_fiscal_descricao')->nullable(); //nome_fantasia
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('responsavel')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
