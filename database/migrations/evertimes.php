<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('overtimes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->date('date');

            $table->time('start_time');

            $table->time('end_time');

            $table->decimal('total_hours', 5, 2)->default(0);

            $table->text('reason')->nullable();

            $table->string('status', 30);

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();

            $table->index('employee_id', 'idx_overtimes_employee_id');
            $table->index('date', 'idx_overtimes_date');
            $table->index('status', 'idx_overtimes_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('overtimes');
    }
};