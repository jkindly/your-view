<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/your-view/app/config/defines.php';

$_SESSION = array();
session_destroy();
header('Location: ' . HOST);