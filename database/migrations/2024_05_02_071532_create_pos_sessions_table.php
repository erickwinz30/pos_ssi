<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pos_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('initial_cash', 50, 2)->nullable();
            $table->decimal('cash_in', 50, 2)->nullable();
            $table->decimal('changes', 50, 2)->nullable();
            $table->decimal('ending_cash', 50, 2)->nullable();
            $table->decimal('ending_cash_actual', 50, 2)->nullable();
            $table->integer('transaction_count')->nullable();
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_sessions');
    }
};
