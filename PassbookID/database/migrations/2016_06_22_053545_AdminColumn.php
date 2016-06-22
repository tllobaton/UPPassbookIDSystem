<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		DB::statement("ALTER TABLE `users` DROP `password`;");
		DB::statement("ALTER TABLE `users` ADD `adminstatus` ENUM('yes','no') NOT NULL DEFAULT 'no' AFTER `email`;");
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
