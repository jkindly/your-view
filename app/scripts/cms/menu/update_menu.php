<?php
require_once '../../../model/cms/Page.php';
require_once '../../../model/cms/Menu.php';
require_once '../../../includes/utils_inc.php';

dump($_POST);

if (!empty($_POST['menu_items'])) {
    $array = $_POST['menu_items'];

    foreach ($array as $key => $item) {
        $displayOrder = $key;
        $explode = explode(":", $item);
        $pageName = $explode[0];
        $pageUri = $explode[1];
        $menu = new Menu();

        $menu->updateMenu($pageName, $pageUri, $displayOrder);
    }
}
header('Location: ' . HOST . 'admin/cms-menu');