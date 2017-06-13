<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
   		Schema::create('subscribers', function (Blueprint $table) {
   			$table->increments('id');
   			$table->string('email', 100);
   			$table->string('status', 20)->nullable();
   			$table->string('first_name', 100)->nullable();
   			$table->string('last_name', 100)->nullable();
   			$table->integer('list_id')->unsigned()->nullable()->index('list_id');
   			$table->nullableTimestamps();
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('subscribers');
    }
}
