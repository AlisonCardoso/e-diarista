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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->foreignId('workshop_id')->constrained()->cascadeOnDelete();
            $table->foreignId('situation_id')->constrained()->cascadeOnUpdate();
            $table->date('service_date');
            $table->decimal('labor_hourly_rate', 10, 2)->nullable();
            $table->integer('labor_hours')->nullable();
            $table->decimal('labor_total', 10, 2)->virtualAs('labor_hourly_rate * labor_hours')->nullable();
            $table->decimal('total_service_order', 10, 2)->nullable(); // Será calculado com o total dos produtos + mão de obra
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('budget_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->integer('product_quantity');
            $table->decimal('product_price', 10, 2);
            $table->decimal('total_product_value', 10, 2)->virtualAs('product_quantity * product_price');
            $table->timestamps();  // Adicionei timestamps aqui para manter o controle sobre quando o produto foi adicionado
            $table->softDeletes();  // Adicionei timestamps aqui para manter o controle sobre quando o produto foi adicionado
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
