<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('payroll_period_id')
                ->constrained('payroll_periods')
                ->cascadeOnDelete();

            $table->decimal('gross_amount', 15, 2)->default(0);

            $table->decimal('deduction_amount', 15, 2)->default(0);

            $table->decimal('net_amount', 15, 2)->default(0);

            $table->string('status', 30);

            $table->date('payment_date')->nullable();

            $table->timestamp('created_at')
                ->nullable()
                ->useCurrent();

            $table->index(
                'employee_id',
                'idx_payrolls_employee_id'
            );

            $table->index(
                'payroll_period_id',
                'idx_payrolls_payroll_period_id'
            );

            $table->index(
                'status',
                'idx_payrolls_status'
            );

            // Satu employee hanya memiliki satu payroll
            // dalam satu payroll period.
            $table->unique(
                ['employee_id', 'payroll_period_id'],
                'unique_employee_payroll_period'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};