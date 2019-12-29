<?php
require 'app/config/defines.php';
require DIR_PATH . DS . 'controller' . DS . 'MainController.php';
require DIR_PATH . DS . 'controller' . DS . 'CMSController.php';

$uri = $_SERVER['REQUEST_URI'];

if (strstr($uri, 'admin/')) {
    $controller = new CMSController();
    $controller->renderView();
} else {
    $controller = new MainController();
    $controller->renderView();
}


