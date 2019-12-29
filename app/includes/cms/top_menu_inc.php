<?php
require_once(dirname(__FILE__).'/../../model/cms/Menu.php');

$menu = new Menu();

$menu->addItem('Home', 1);
$menu->addItem('Ranking', 2);
$menu->addItem('Kategorie', 3);