<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payroll_thrs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->year('year');

            $table->decimal('amount', 15, 2)->default(0);

            $table->date('payment_date')->nullable();

            $table->string('status', 30);

            $table->text('notes')->nullable();

            $table->foreignId('created_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamp('created_at')
                ->nullable()
                ->useCurrent();

            $table->index(
                'employee_id',
                'idx_payroll_thrs_employee_id'
            );

            $table->index(
                'year',
                'idx_payroll_thrs_year'
            );

            $table->index(
                'status',
                'idx_payroll_thrs_status'
            );

            $table->index(
                'created_by',
                'idx_payroll_thrs_created_by'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_thrs');
    }
};