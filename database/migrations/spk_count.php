<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spk_count', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('spk_number', 50);

            $table->date('work_date');

            $table->text('description')->nullable();

            $table->integer('quantity')->default(0);

            $table->string('status', 30);

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();

            $table->index(
                'employee_id',
                'idx_spk_count_employee_id'
            );

            $table->index(
                'work_date',
                'idx_spk_count_work_date'
            );

            $table->index(
                'status',
                'idx_spk_count_status'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spk_count');
    }
};