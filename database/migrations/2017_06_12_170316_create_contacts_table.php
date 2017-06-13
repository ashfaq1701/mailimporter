<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('contacts', function (Blueprint $table) {
    		$table->increments('id');
    		$table->string('company', 50)->nullable();
    		$table->string('address1', 200)->nullable();
    		$table->string('address2', 200)->nullable();
    		$table->string('city', 200)->nullable();
    		$table->string('state', 200)->nullable();
    		$table->string('zip', 50)->nullable();
    		$table->string('country', 100)->nullable();
    		$table->string('phone', 30)->nullable();
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
    	Schema::dropIfExists('contacts');
    }
}
