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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->foreignId('sender_id')->constrained('offices');
            $table->foreignId('receiver_id')->constrained('offices');
			$table->datetime('date');
			$table->string('currency');
			$table->string('percentage');
			// $table->string('status');
			$table->bigInteger('total_amount');
			$table->string('notes', 500);
            $table->timestamps();
			$table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
