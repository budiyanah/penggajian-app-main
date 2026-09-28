<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_payroll_components', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('component_id')
                ->constrained('payroll_components')
                ->cascadeOnDelete();

            $table->decimal('rate', 15, 2)->default(0);

            $table->date('effective_from');

            $table->date('effective_to')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('employee_id', 'idx_epc_employee_id');
            $table->index('component_id', 'idx_epc_component_id');
            $table->index('effective_from', 'idx_epc_effective_from');
            $table->index('is_active', 'idx_epc_is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_payroll_components');
    }
};