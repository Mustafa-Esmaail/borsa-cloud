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
        Schema::create('manual_offices', function (Blueprint $table) {
            $table->id();
            $table->string('office_name', 255);
			$table->string('office_owner', 255);
			$table->string('country', 255);
			$table->string('city', 255);
			// $table->string('avatar', 500);
			$table->string('phone', 200);
			$table->string('notes', 200);
            $table->foreignId('office_id')->constrained('offices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_offices');
    }
};
