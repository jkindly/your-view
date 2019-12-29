<?php
require_once (dirname(__FILE__).'/../Model.php');

class Menu extends Model
{
    public function addItem($itemName, $order) {
        $this->insert('menu', ['name' => $itemName, 'display_order' => $order]);
    }

    public function getItems() {
        return $this->fetch('menu');
    }
}