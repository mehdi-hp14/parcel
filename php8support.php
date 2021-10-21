<?php
require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('LARAVEL_START')) {
    require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'A0' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'laravel_inclusion.php';
}

if (auth()->guard('adminGuard')->check() && (!isset($_SESSION['loged_in_t']) || $_SESSION['loged_in_t'] < time())) {
    //if laravel logged in we should add the session
    $_SESSION['loged_in'] = true;
    $_SESSION['loged_in_t'] = time() + 18200;
    $_SESSION['can_register_new_admins'] = time() + 18200;
} elseif (auth()->guard('adminGuard')->check() === false && $_SERVER['REQUEST_METHOD'] === 'GET') {
    //laravel is not authenticated so we should remove the auth sessions
    unset($_SESSION['loged_in'], $_SESSION['loged_in_t']);
}

const BASE_DIR = __DIR__;
function mysql_connect()
{
    return $_SESSION['mysql_connect'] = mysqli_connect(...func_get_args());
}

function mysql_error($conn = null)
{
    return mysqli_error($conn ?? $_SESSION['mysql_connect']);
}

function mysql_select_db($dbName, $conn)
{
    return mysqli_select_db($conn, $dbName);
}

function mysql_fetch_array()
{
    return mysqli_fetch_array(...func_get_args());
}

function mysql_fetch_assoc()
{
    return mysqli_fetch_assoc(...func_get_args());
}

function mysql_query($query)
{
    return mysqli_query($_SESSION['mysql_connect'], $query);
}

function mysql_insert_id()
{
    return mysqli_insert_id(...func_get_args());
}

function mysql_num_rows()
{
    return mysqli_num_rows(...func_get_args());
}

function mysql_close()
{
    return mysqli_close($_SESSION['mysql_connect']);
}

function sql_regcase($string)
{
    return $string . 'i';
}

class PHPMailer extends PHPMailer\PHPMailer\PHPMailer
{
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
