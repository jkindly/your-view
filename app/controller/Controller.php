<?php

include_once DIR_PATH . DS . 'config' . DS . 'defines.php';
include_once DIR_PATH . DS . 'includes' . DS . 'utils_inc.php';
class Controller
{
    private $uri = [];
    private $view = [];
    private $pageTitle = [];

    /**
     * Creating all available routes
     */
    public function __construct() {
        $this->addRoute('/', 'home.phtml', 'Your view - strona główna');
        $this->addRoute('/login', 'login.phtml', 'Zaloguj się');
        $this->addRoute('/settings', 'user_settings.phtml', 'Ustawienia konta');
    }

    public function addRoute($uri, $view, $pageTitle) {
        $this->uri[] = $uri;
        $this->view[] = $view;
        $this->pageTitle[] = $pageTitle;
    }

    /**
     * Getting the uri, if it's not set, then default is homepage
     */
    public function renderView() {
        $uriGetParam = isset($_GET['uri']) ? ('/' . $_GET['uri']) : '/';
        $viewKey = array_search($uriGetParam, $this->uri);

        if (in_array($uriGetParam, $this->uri)) {
            $file = DIR_PATH . DS . 'view' . DS . $this->view[$viewKey];
            includeView($file, [
                'title' => $this->pageTitle[$viewKey]
            ]);
        } else {
            require DIR_PATH . DS . 'view' . DS . '404.html';
        }
    }
}