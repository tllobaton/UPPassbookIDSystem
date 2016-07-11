<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;

use Thenextweb\PassGenerator;

use Storage;

class PassbookIdController extends Controller
{
    public function makePass() {
		$pass_identifier = 'mingsming';  // This, if set, it would allow for retrieval later on of the created Pass

		$pass = new PassGenerator($pass_identifier);

		$pass_definition = [
			"description"       => "description",
			"formatVersion"     => 1,
			"organizationName"  => "University of the Philippines",
			"passTypeIdentifier"=> "pass.com.example.appname",
			"serialNumber"      => "123456",
			"teamIdentifier"    => "A7FDKGVVEB",
			"foregroundColor"   => "rgb(99, 99, 99)",
			"backgroundColor"   => "rgb(212, 212, 212)",
			"barcode" => [
				"message"   => "encodedmessageonQR",
				"format"    => "PKBarcodeFormatQR",
				"altText"   => "altextfortheQR",
				"messageEncoding"=> "utf-8",
			],
			"generic" => [
				"headerFields" => [
					[
						"key" => "UP",
						"label" => "University of the Philippines",
						"value" => "Diliman",
						
					]
				],
				"primaryFields" => [
					[
						"key" => "name",
						"label" => "Troi Vinceasdddddddddddddddnt Elijah L. Lobaton",
						"value" => "2013-49426",
					]
				],
				"secondaryFields" => [
					[
						"key" => "college",
						"value" => "College of Engineering"
					]
				],
				"backFields" => [
					[
						"key" => "ticketNumber",
						"label" => "Ticket Number",
						"value" => "7612800569875"
					], [
						"key" => "passenger-name",
						"label" => "Passenger",
						"value" => "John Doe"
					], [
						"key" => "classback",
						"label" => "Class",
						"value" => "Tourist"
					]
				],
				"locations" => [
					[
						"latitude" => 37.97479,
						"longitude" => -1.131522,
						"relevantText" => "Departure station"
					]
				],
				"transitType" => "PKTransitTypeTrain"
			],
		];

		$pass->setPassDefinition($pass_definition);

		// Definitions can also be set from a JSON string
		// $pass->setPassDefinition(file_get_contents('/path/to/pass.json));

		// Add assets to the PKPass package
		//$pass->addAsset(base_path('resources\assets\wallet\background.png'));
		$pass->addAsset(base_path('resources\assets\wallet\thumbnail.png'));
		$pass->addAsset(base_path('resources\assets\wallet\icon.png'));
		$pass->addAsset(base_path('resources\assets\wallet\logo.png'));

		$pkpass = $pass->create();
		
		return new Response($pkpass, 200, [
			'Content-Transfer-Encoding' => 'binary',
			'Content-Description' => 'File Transfer',
			'Content-Disposition' => 'attachment; filename="pass.pkpass"',
			'Content-length' => strlen($pkpass),
			'Content-Type' => PassGenerator::getPassMimeType(),
			'Pragma' => 'no-cache',
		]);
	}
	
	public function removePass() {
		if (Storage::disk('passgenerator')->has('mingsming.pkpass')) {	
            Storage::disk('passgenerator')->delete('mingsming.pkpass');
        }
		return redirect("/Landing");
	}
	
	
}
