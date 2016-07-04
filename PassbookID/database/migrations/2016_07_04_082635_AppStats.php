<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campus', function($table){
			$table->integer('studentuse')->default(0);
			$table->integer('totalstudents')->default(0);
			$table->integer('empuse')->default(0);
			$table->integer('totalemps')->default(0);
		});
		
		Schema::table('users', function($table){
			$table->enum('createdsid', array('yes', 'no'))->default('no');
			$table->enum('createdeid', array('yes', 'no'))->default('no');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
