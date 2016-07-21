<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDepartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('dept', function($table){
			DB::statement("INSERT INTO `dept` (`id`,`dname`) VALUES
				('','College of Arts and Letters'),
				('','College of Fine Arts'),
				('','College of Human Kinetics'),
				('','College of Mass Communication'),
				('','College of Music'),
				('','Asian Institute of Tourism'),
				('','Virata School of Business'),
				('','School of Economics'),
				('','School of Labor and Industrial Relations'),
				('','National College of Public Administration and Governance'),
				('','School of Urban and Regional Planning'),
				('','Technology Management Center'),
				('','UPD Extension Program in Pampanga and Olongapo'),
				('','Archaeological Studies Program'),
				('','College of Architecture'),
				('','College of Engineering'),
				('','College of Home Economics'),
				('','College of Science'),
				('','School of Library and Information Studies'),
				('','School of Statistics'),
				('','Asian Center'),
				('','College of Education'),
				('','Institute of Islamic Studies'),
				('','College of Law'),
				('','College of Social Sciences and Philosophy'),
				('','College of Social Work and Community Development'),
				
				('','College of Arts and Communication'),
				('','College of Social Sciences'),
				('','Institute of Management'),
				
				('','College of Allied Medical Professions'),
				('','College of Arts and Sciences'),
				('','College of Dentistry'),
				('','College of Medicine'),
				('','College of Nursing'),
				('','College of Pharmacy'),
				('','College of Public Health'),
				('','National Teacher Training Center for the Health Professions'),
				('','School of Health Sciences'),
				
				('','College of Agriculture'),
				('','College of Development Communication'),
				('','College of Engineering and Agro-industrial Technology'),
				('','Economics and Management'),
				('','College of Environmental Science and Management'),
				('','College of Forestry and Natural Resources'),
				('','College of Human Ecology'),
				('','College of Public Affairs and Development'),
				('','College of Veterinary Medicine'),
				
				('','Arts and Humanities'),
				('','Business Management'),
				('','Sciences'),
				('','Social Sciences'),
				
				('','College of Fisheries and Ocean Sciences'),
				('','College of Management'),
				('','School of Technology'),
				('','UPV Tacloban College'),
				('','College of Humanities and Social Sciences'),
				('','College of Science and Mathematics'),
				
				('','Faculty of Education'),
				('','Faculty of Information and Communication Studies'),
				('','Faculty of Management and Development Studies')		
			");
		});
		
		Schema::table('campus_dept', function($table){
			DB::statement("INSERT INTO `campus_dept` (`id`, `cname`,`dname`) VALUES
				('', 'Diliman','College of Arts and Letters'),
				('', 'Diliman','College of Fine Arts'),
				('', 'Diliman','College of Human Kinetics'),
				('', 'Diliman','College of Mass Communication'),
				('', 'Diliman','College of Music'),
				('', 'Diliman','Asian Institute of Tourism'),
				('', 'Diliman','Virata School of Business'),
				('', 'Diliman','School of Economics'),
				('', 'Diliman','School of Labor and Industrial Relations'),
				('', 'Diliman','National College of Public Administration and Governance'),
				('', 'Diliman','School of Urban and Regional Planning'),
				('', 'Diliman','Technology Management Center'),
				('', 'Diliman','UPD Extension Program in Pampanga and Olongapo'),
				('', 'Diliman','Archaeological Studies Program'),
				('', 'Diliman','College of Architecture'),
				('', 'Diliman','College of Engineering'),
				('', 'Diliman','College of Home Economics'),
				('', 'Diliman','College of Science'),
				('', 'Diliman','School of Library and Information Studies'),
				('', 'Diliman','School of Statistics'),
				('', 'Diliman','Asian Center'),
				('', 'Diliman','College of Education'),
				('', 'Diliman','Institute of Islamic Studies'),
				('', 'Diliman','College of Law'),
				('', 'Diliman','College of Social Sciences and Philosophy'),
				('', 'Diliman','College of Social Work and Community Development'),
				
				('', 'Baguio','College of Science'),
				('', 'Baguio','College of Arts and Communication'),
				('', 'Baguio','College of Social Sciences'),
				('', 'Baguio','Institute of Management'),
				
				('', 'Manila','College of Allied Medical Professions'),
				('', 'Manila','College of Arts and Sciences'),
				('', 'Manila','College of Dentistry'),
				('', 'Manila','College of Medicine'),
				('', 'Manila','College of Nursing'),
				('', 'Manila','College of Pharmacy'),
				('', 'Manila','College of Public Health'),
				('', 'Manila','National Teacher Training Center for the Health Professions'),
				('', 'Manila','School of Health Sciences'),
				
				('', 'Los Baños','College of Agriculture'),
				('', 'Los Baños','College of Arts and Sciences'),
				('', 'Los Baños','College of Development Communication'),
				('', 'Los Baños','College of Engineering and Agro-industrial Technology'),
				('', 'Los Baños','Economics and Management'),
				('', 'Los Baños','College of Environmental Science and Management'),
				('', 'Los Baños','College of Forestry and Natural Resources'),
				('', 'Los Baños','College of Human Ecology'),
				('', 'Los Baños','College of Public Affairs and Development'),
				('', 'Los Baños','College of Veterinary Medicine'),
				
				('', 'Cebu','Arts and Humanities'),
				('', 'Cebu','Business Management'),
				('', 'Cebu','Sciences'),
				('', 'Cebu','Social Sciences'),
				
				('', 'Visayas','College of Fisheries and Ocean Sciences'),
				('', 'Visayas','College of Arts and Sciences'),
				('', 'Visayas','College of Management'),
				('', 'Visayas','School of Technology'),
				('', 'Visayas','UPV Tacloban College'),
				
				('', 'Mindanao','College of Humanities and Social Sciences'),
				('', 'Mindanao','College of Science and Mathematics'),
				
				('', 'Open University','Faculty of Education'),
				('', 'Open University','Faculty of Information and Communication Studies'),
				('', 'Open University','Faculty of Management and Development Studies')		
			");
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
