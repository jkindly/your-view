<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

define("DB_HOST", "serwer1936460.home.pl");
define("DB_NAME", "31300146_kozupa");
define("DB_USER", "31300146_kozupa");
define("DB_PASSWORD", "q1swupBMD");

define("DIR_PATH", dirname(__DIR__));
define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT']);
define("DS", DIRECTORY_SEPARATOR);
define('HOST', 'http://' . $_SERVER['SERVER_NAME'] . '/your-view/');

//USER DEFINES
define('USER_LOGGED_IN', isset($_SESSION['id'])? true : false);



