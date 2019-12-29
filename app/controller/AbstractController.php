<?php


abstract class AbstractController
{
    protected $uri = [];
    protected $view = [];

    public function addRoute($uri, $view) {
        $this->uri[] = $uri;
        $this->view[] = $view;
    }

    public abstract function renderView();
}