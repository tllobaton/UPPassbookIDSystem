<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCampus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("INSERT INTO `campus` (`id`, `cname`, `expire`) VALUES (NULL, 'Baguio', NULL);");
		DB::statement("INSERT INTO `campus` (`id`, `cname`, `expire`) VALUES (NULL, 'Cebu', NULL);");
		DB::statement("INSERT INTO `campus` (`id`, `cname`, `expire`) VALUES (NULL, 'Diliman', NULL);");
		DB::statement("INSERT INTO `campus` (`id`, `cname`, `expire`) VALUES (NULL, 'Los Baños', NULL);");
		DB::statement("INSERT INTO `campus` (`id`, `cname`, `expire`) VALUES (NULL, 'Manila', NULL);");
		DB::statement("INSERT INTO `campus` (`id`, `cname`, `expire`) VALUES (NULL, 'Mindanao', NULL);");
		DB::statement("INSERT INTO `campus` (`id`, `cname`, `expire`) VALUES (NULL, 'Open University', NULL);");
		DB::statement("INSERT INTO `campus` (`id`, `cname`, `expire`) VALUES (NULL, 'Visayas', NULL);");
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
