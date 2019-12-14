<?php
require 'app/config/defines.php';
require DIR_PATH . DS . 'controller' . DS . 'Controller.php';

$controller = new Controller();
$controller->renderView();
