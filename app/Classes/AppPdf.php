<?php
namespace App\Classes;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class AppPdf 
{
    // this is the images types that i have becouse evry type has his own path
    // public static string $ImageForDownload = 'download';
    public const ImageForDownload     = 'download';
    public const ImageForSend         = 'send';
    public const ImageForView         = 'view';

    public static $pdf ; 

    // public static string $ImageForView     = 'view';
    // public static string $ImageForSend     = 'send';


    // public $data = null ; 

    private static $instance  = null ;
    private function __construct()
    {

    }

    public static function getInstance()
    {
        if(self::$instance ===  null){
            self::$instance = new self();
        }
        return self::$instance;
    }



    public static function make(string $type = '' , string $view , $invoicedetails)
    {
        self::$pdf = Pdf::loadView($view, compact('invoicedetails' , 'type'));
            
        return self::getInstance();
    }


    public function download()
    {
        return self::$pdf->download(Str::random().'.pdf');
    }



    public function output()
    {
        return self::$pdf->output();
    }

} 
