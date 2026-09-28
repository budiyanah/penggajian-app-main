<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_activities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnDelete();

            $table->date('work_date');

            $table->string('route', 100);

            $table->integer('quantity')->default(0);

            $table->text('description')->nullable();

            $table->string('status', 30);

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->timestamp('created_at')
                ->nullable()
                ->useCurrent();

            $table->timestamp('updated_at')
                ->nullable()
                ->useCurrent()
                ->useCurrentOnUpdate();

            $table->index('employee_id', 'idx_delivery_activities_employee_id');
            $table->index('work_date', 'idx_delivery_activities_work_date');
            $table->index('status', 'idx_delivery_activities_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_activities');
    }
};