<?php

require_once (dirname(__FILE__).'/../model/Model.php');
abstract class AbstractController extends Model
{
    protected $uri = [];
    protected $view = [];

    public function addRoute($uri, $view) {
        $this->uri[] = $uri;
        $this->view[] = $view;
    }

    public abstract function renderView();
}