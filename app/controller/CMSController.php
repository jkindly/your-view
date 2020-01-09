<?php

include_once DIR_PATH . DS . 'config' . DS . 'defines.php';
include_once DIR_PATH . DS . 'includes' . DS . 'utils_inc.php';
require_once 'AbstractController.php';

class CMSController extends AbstractController
{
    public function __construct() {
        $this->addRoute('/admin/cms-new-page', 'pages\new_page.phtml');
        $this->addRoute('/admin/cms-manage-pages', 'pages\manage_pages.phtml');
        $this->addRoute('/admin/cms-menu', 'menu.phtml');
        $this->addRoute('/admin/cms-settings', 'settings.phtml');
        $this->addRoute('/admin/cms-edit-page', 'pages\edit_page.phtml');
        $this->addRoute('/admin/cms-seo', 'settings\seo.phtml');
    }

    public function renderView()
    {
        $uriGetParam = isset($_GET['uri']) ? ('/' . $_GET['uri']) : '/';
        $viewKey = array_search($uriGetParam, $this->uri);

        if (in_array($uriGetParam, $this->uri)) {
            $file = DIR_PATH . DS . 'view\cms' . DS . $this->view[$viewKey];
            includeView($file);
        } else {
            header("HTTP/1.0 404 Not Found");
            require DIR_PATH . DS . 'view' . DS . '404.html';
        }
    }

}