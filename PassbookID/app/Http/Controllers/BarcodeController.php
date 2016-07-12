<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PicoPrime\BarcodeGen\BarcodeGenerator;

class BarcodeController extends Controller
{
    /**
     * @var \PicoPrime\BarcodeGen\BarcodeGenerator
     */
    protected $barcode;

    public function __construct(BarcodeGenerator $barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     * Generate barcode as DATA URL image.
     *
     * @param string $text
     * @param int $size
     * @param float $scale
     * @param string $orientation
     * @param string $codeType
     * @return \Intervention\Image\Image
     * @throws \Exception
     */
    public function barcodeAsDataUrl(
        $text = '',
        $size = 50,
        $scale = 1,
        $orientation = 'horizontal',
        $codeType = 'code39'
    ) {
        return $this->barcode
            ->generate(compact('text', 'size', 'orientation', 'codeType', 'scale'))
            ->encode('data-url');
    }

    /**
     * Generate barcode as PNG image.
     *
     * @param string $text
     * @param int $size
     * @param float $scale
     * @param string $orientation
     * @param string $codeType
     * @return mixed
     * @throws \Exception
     */
    public function barcodeAsPng(
        $text = '201349426',
        $size = 50,
        $scale = 1,
        $orientation = 'horizontal',
        $codeType = 'code39'
    ) {
        return $this->barcode
            ->generate(compact('text', 'size', 'orientation', 'codeType', 'scale'))
            ->response->download('background.png');
    }
	
	public function barcodeMove() {
		
	$this->barcodeAsPng();
	
	}
}
