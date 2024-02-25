<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration {

	public function up()
	{
		Schema::create('offices', function(Blueprint $table) {
			$table->id();
			$table->string('office_name', 255);
			$table->string('office_owner', 255);
			$table->string('country', 255);
			$table->string('city', 255);
			$table->string('avatar', 500);
			$table->string('phone', 200);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('offices');
	}
}
