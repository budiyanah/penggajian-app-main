<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payroll_periods', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);

            $table->date('period_start');

            $table->date('period_end');

            $table->date('payment_date')->nullable();

            $table->string('status', 30);

            $table->timestamps();

            $table->index(
                'period_start',
                'idx_payroll_periods_period_start'
            );

            $table->index(
                'period_end',
                'idx_payroll_periods_period_end'
            );

            $table->index(
                'status',
                'idx_payroll_periods_status'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_periods');
    }
};