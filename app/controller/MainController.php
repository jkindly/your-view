<?php

include_once DIR_PATH . DS . 'config' . DS . 'defines.php';
include_once DIR_PATH . DS . 'includes' . DS . 'utils_inc.php';
require_once 'AbstractController.php';
class MainController extends AbstractController
{
    public function __construct() {
        parent::__construct();
        $this->addRoute('/', 'home.phtml');
        $this->addRoute('/login', 'login.phtml');
        $this->addRoute('/settings', 'user_settings.phtml');
        $this->addRoute('/admin', 'admin.phtml');
    }

    public function dynamicViews() {
        $pages = $this->fetch('page');

        foreach ($pages as $page) {
            $this->addRoute('/'.$page['uri'], 'base_template.phtml');
        }
    }

    public function renderView() {
        $uriGetParam = isset($_GET['uri']) ? ('/' . $_GET['uri']) : '/';
        $viewKey = array_search($uriGetParam, $this->uri);

        if (in_array($uriGetParam, $this->uri)) {
            $file = DIR_PATH . DS . 'view' . DS . $this->view[$viewKey];
            includeView($file);
        } else {
            header("HTTP/1.0 404 Not Found");
            require DIR_PATH . DS . 'view' . DS . '404.html';
        }
    }
}