<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payroll_incentives', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('payroll_period_id')
                ->constrained('payroll_periods')
                ->cascadeOnDelete();

            $table->decimal('amount', 15, 2)->default(0);

            $table->text('reason')->nullable();

            $table->string('status', 30);

            $table->foreignId('created_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->timestamp('created_at')
                ->nullable()
                ->useCurrent();

            $table->index(
                'employee_id',
                'idx_payroll_incentives_employee_id'
            );

            $table->index(
                'payroll_period_id',
                'idx_payroll_incentives_payroll_period_id'
            );

            $table->index(
                'status',
                'idx_payroll_incentives_status'
            );

            $table->index(
                'created_by',
                'idx_payroll_incentives_created_by'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_incentives');
    }
};