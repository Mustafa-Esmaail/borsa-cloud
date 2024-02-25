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
        Schema::create('office_currency', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id')->constrained('offices')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('currency_id')->constrained('currency')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('sell_price')->nullable();
            $table->string('buy_price')->nullable();
            $table->decimal("wallet_balance", 16, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_currency');
    }
};
