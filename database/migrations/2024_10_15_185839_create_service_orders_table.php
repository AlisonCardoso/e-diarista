<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\softDeletes;

return new class extends Migration
{
    /**
     * Executa as migrações.
     */
    public function up(): void
    {
        // Tabela de service_orders
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->foreignId('workshop_id')->constrained()->cascadeOnDelete();
            $table->foreignId('situation_id')->constrained()->cascadeOnUpdate();
            $table->date('service_date');
            $table->decimal('labor_hourly_rate', 10, 2)->nullable(); // Valor por hora da mão de obra
            $table->integer('labor_hours')->nullable(); // Duração total da mão de obra em horas
            $table->decimal('labor_total', 10, 2)->nullable();
            $table->longText('description')->nullable();
            $table->decimal('order_total', 10, 2);
            $table->decimal('total_service_order', 10, 2)->nullable()->virtualAs('order_total + labor_total');// Será calculado com o total dos produtos + mão de obra
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabela intermediária service_order_product
        Schema::create('service_order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->integer('product_quantity'); // Quantidade de produtos
            $table->decimal('product_price', 10, 2); // Preço unitário no momento da ordem
            $table->decimal('total_product_value', 10, 2)->virtualAs('product_quantity * product_price'); // Valor total
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_order_product'); // Apaga a tabela intermediária
        Schema::dropIfExists('service_orders'); // Apaga a tabela de service_orders
    }
};
