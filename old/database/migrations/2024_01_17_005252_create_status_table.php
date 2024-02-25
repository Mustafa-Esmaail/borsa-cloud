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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            // $table->string('message');
            // $table->string('image')->nullable();
            $table->string('sell_price')->nullable();
            $table->string('buy_price')->nullable();
            $table->json('views')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            $table->foreignId('office_id')->constrained('offices')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('currency_id')->constrained('currency')->default(5)->cascadeOnDelete()->cascadeOnUpdate();


            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
