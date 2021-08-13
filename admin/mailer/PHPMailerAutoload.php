<?php
require_once $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use PHPMailer\PHPMailer\PHPMailer as P;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PHPMailer{
    public function __construct()
    {
        return $x =  new P(true);
//        var_dump(method_exists($x,'setFrom'));
//        die();
    }
}
//spl_autoload_register();