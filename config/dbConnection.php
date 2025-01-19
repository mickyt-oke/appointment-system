<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(1);
session_start();
if(!(isset($_SESSION["us3rid"]))) {
    $error[] = "Session Timeout. Please reauthenticate to continue";
    header("Location:logout.php?session_expired=1");
} else{

}

// Define paths
define("DS", DIRECTORY_SEPARATOR);
define("APP_ROOT", dirname(dirname(__FILE__)).DS);

// Require resource files  
require_once APP_ROOT . "core/common.php";
require_once APP_ROOT . "core/functions.php";
require_once APP_ROOT . "config/init-1.php";

// Objects/instances of classes

$user = new User();
$entry = new Entry();
$session = new Session();
$message = $session->message();

//Init
$errors = array();

// Obtain the filename of current page
$page = basename($_SERVER['PHP_SELF']);