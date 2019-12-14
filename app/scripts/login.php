<?php
include $_SERVER['DOCUMENT_ROOT'].'/your-view/app/config/defines.php';
require DIR_PATH . DS . 'model' . DS . 'User.php';
if (!isset($_POST['submit']))
    //todo add header
    return;

$login = isset($_POST['login']) ? $_POST['login'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";

if (empty($login) || empty($password))
    //todo add header
    return;

$user = new User($login, $password);
$user->login();
