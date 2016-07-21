<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
			$table->string("fname")->nullable()->default(null);
			$table->string("mname")->nullable()->default(null);
			$table->string("lname")->nullable()->default(null);
			$table->string("sname")->nullable()->default(null);
			
			$table->enum('isenrolled', array('yes', 'no'))->default('no');
			$table->enum('isemployed', array('yes', 'no'))->default('no');
			$table->enum('isadmin', array('yes', 'no'))->default('no');
			
			$table->string("sn_year")->nullable()->default(null);
			$table->string("sn_num")->nullable()->default(null);
			$table->string("campus")->nullable()->default(null);
			$table->string("dept")->nullable()->default(null);

			$table->string("empnum")->nullable()->default(null);			
			$table->string("gsis")->nullable()->default(null);
			$table->string("blood")->nullable()->default(null);
			$table->string("tin")->nullable()->default(null);
			$table->string("empstatus")->nullable()->default(null);
			
			$table->string("ename")->nullable()->default(null);
			$table->string("enum")->nullable()->default(null);
			$table->string("eaddress")->nullable()->default(null);
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
