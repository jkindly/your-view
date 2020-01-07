<?php
require_once (dirname(__FILE__).'/../Model.php');

class Menu extends Model
{
    private $id;
    private $name;
    private $displayOrder;

    public function addItem($itemName, $order) {
        $this->insert('menu', ['name' => $itemName, 'display_order' => $order]);
    }

    private function createArrayOfObjects($array) {
        $arrayOfObjects = array();
        foreach ($array as $menuItem) {
            $newMenuItem = new Menu();

            $newMenuItem->setId($menuItem['id'])
                ->setName($menuItem['name'])
                ->setDisplayOrder($menuItem['display_order']);
            unset($newMenuItem->pdo);

            array_push($arrayOfObjects, $newMenuItem);
        }

        return $arrayOfObjects;
    }

    public function getMenuLevel1() {;
        $menuItems = $this->fetch('menu_level1');

        return $this->createArrayOfObjects($menuItems);
    }

    public function getMenuLevel2($parentId) {
        $menuItems = $this->fetchWithWhere('menu_level2', 'id_menu_level1', $parentId);

        return $this->createArrayOfObjects($menuItems);
    }

    public function getMenuLevel3($parentId) {
        $menuItems = $this->fetchWithWhere('menu_level3', 'id_menu_level2', $parentId);

        return $this->createArrayOfObjects($menuItems);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    public function setDisplayOrder($displayOrder)
    {
        $this->displayOrder = $displayOrder;
        return $this;
    }
}