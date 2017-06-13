<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('lists', function (Blueprint $table) {
    		$table->increments('id');
    		$table->string('provider', 20);
    		$table->string('provider_id', 50);
    		$table->string('name', 100);
    		$table->text('permission_reminder')->nullable();
    		$table->integer('contact_id')->unsigned()->nullable()->index('contact_id');
    		$table->integer('campaign_id')->unsigned()->nullable()->index('campaign_id');
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
    	Schema::dropIfExists('lists');
    }
}
