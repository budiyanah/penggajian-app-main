<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payroll_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('payroll_id')
                ->constrained('payrolls')
                ->cascadeOnDelete();

            $table->foreignId('component_id')
                ->nullable()
                ->constrained('payroll_components')
                ->nullOnDelete();

            $table->string('component_name', 100);

            $table->string('calculation_type', 30);

            $table->decimal('rate', 15, 2)->default(0);

            $table->decimal('quantity', 15, 2)->default(0);

            $table->decimal('amount', 15, 2)->default(0);

            $table->string('reference_type', 50)->nullable();

            $table->unsignedBigInteger('reference_id')->nullable();

            $table->index(
                'payroll_id',
                'idx_payroll_items_payroll_id'
            );

            $table->index(
                'component_id',
                'idx_payroll_items_component_id'
            );

            $table->index(
                ['reference_type', 'reference_id'],
                'idx_payroll_items_reference'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_items');
    }
};