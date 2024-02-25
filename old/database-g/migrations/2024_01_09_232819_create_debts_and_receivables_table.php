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
        Schema::create('debts_and_receivables', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('amount', 255);
            $table->string('type', 255);
            $table->foreignId('currency_id')->constrained('currency')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('office_id')->constrained('offices')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->datetime('date');
            $table->string('notes', 555)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts_and_receivables');
    }
};
