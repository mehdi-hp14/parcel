<?php
require_once $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

const BASE_DIR = __DIR__;
function mysql_connect(){return $_SESSION['mysql_connect'] = mysqli_connect(...func_get_args()); }
function mysql_error($conn=null){
    return mysqli_error($conn ?? $_SESSION['mysql_connect']);
}
function mysql_select_db($dbName,$conn){
    return mysqli_select_db($conn,$dbName);
}
function mysql_fetch_array(){ return mysqli_fetch_array(...func_get_args()); }
function mysql_fetch_assoc(){ return mysqli_fetch_assoc(...func_get_args()); }
function mysql_query($query){
    return mysqli_query($_SESSION['mysql_connect'],$query);
}
function mysql_insert_id(){ return mysqli_insert_id(...func_get_args()); }
function mysql_num_rows(){ return mysqli_num_rows(...func_get_args()); }

function mysql_close(){
    return mysqli_close($_SESSION['mysql_connect']);
}
function sql_regcase($string){ return $string.'i'; }

class PHPMailer extends PHPMailer\PHPMailer\PHPMailer{
//    public function __call(string $name, array $arguments)
//    {
//        $PHPMailer =  new PHPMailer\PHPMailer\PHPMailer();
//        return (new $PHPMailer)->{$name}(...$arguments);
//    }

//    public function __construct()
//    {
//        return new PHPMailer\PHPMailer\PHPMailer();

//    }
}
