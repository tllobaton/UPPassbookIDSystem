<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDept extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('dept', function (Blueprint $table) {
			$table->increments('id');
			$table->string('dname');
		});
		
		Schema::create('campus_dept', function (Blueprint $table) {
			$table->increments('id');
			$table->string('cname');
			$table->string('dname');
		});
		
		Schema::table('campus_dept', function($table){
			$table->foreign('cname')->references('cname')->on('campus')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('dname')->references('dname')->on('deot')->onDelete('cascade')->onUpdate('cascade');	
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
