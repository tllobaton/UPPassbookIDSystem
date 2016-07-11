<?php namespace App

class HardCodePassGeneratorProvider extends Thenextweb\PassGenerator {
	public function __construct($pass_id = false, $replace_existent = false)
    {
        // Set certificate
		
        if (is_file(config('passgenerator.certificate_store_path'))) {
			
            //$this->cert_store = file_get_contents(config('passgenerator.certificate_store_path'));
			// Hard code certificate path
			$this->cert_store = file_get_contents("C:\wamp64\www\PassbookID\PassbookID\public\certificate\pass.pfx");
        } else {
            throw new InvalidArgumentException("No certificate found on " . config('passgenerator.certificate_store_path'));
        }

        // Set password
        $this->cert_store_password = config('passgenerator.certificate_store_password');


        if (is_file(config('passgenerator.wwdr_certificate_path')) && @openssl_x509_read(file_get_contents(config('passgenerator.wwdr_certificate_path')))) {
            $this->wwdr_cert_path= config('passgenerator.wwdr_certificate_path');
        } else {
            $error_msg = "No valid intermediate certificate was found on " . config('passgenerator.wwdr_certificate_path'). PHP_EOL;
            $error_msg .= "The WWDR intermediate certificate must be on PEM format, ";
            $error_msg .= "the DER version can be found at https://www.apple.com/certificateauthority/ ";
            $error_msg .= "But you'll need to export it into PEM.";
            throw new InvalidArgumentException($error_msg);
        }

        $this->assets = [];

        if (!$pass_id) {
            $pass_id = uniqid('pass_', true);
        }
        $this->pass_relative_path = "$pass_id";
        $this->pass_filename = "$pass_id.pkpass";
        if (Storage::disk('passgenerator')->has($this->pass_filename)) {
            if ($replace_existent) {
                Storage::disk('passgenerator')->delete($this->pass_filename);
            } else {
                throw new \RuntimeException("The file {$this->pass_filename} already exists, try another pass_id or download.");
            }
        }
        $this->pass_real_path = Storage::disk('passgenerator')->getDriver()->getAdapter()->getPathPrefix() . $this->pass_relative_path;
    }

}