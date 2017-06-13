<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('lists', function(Blueprint $table)
    	{
    		$table->foreign('contact_id', 'fk_lists_1')->references('id')->on('contacts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
    		$table->foreign('campaign_id', 'fk_lists_2')->references('id')->on('campaigns')->onUpdate('NO ACTION')->onDelete('NO ACTION');
    	});
    	Schema::table('subscribers', function(Blueprint $table)
    	{
    		$table->foreign('list_id', 'fk_subscribers_1')->references('id')->on('lists')->onUpdate('NO ACTION')->onDelete('NO ACTION');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('lists', function(Blueprint $table)
    	{
    		$table->dropForeign('fk_lists_1');
    		$table->dropForeign('fk_lists_2');
    	});
    	Schema::table('subscribers', function(Blueprint $table)
    	{
    		$table->dropForeign('fk_subscribers_1');
    	});
    }
}
