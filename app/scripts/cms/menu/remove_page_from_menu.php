<?php
require_once '../../../model/cms/Page.php';
require_once '../../../model/cms/Menu.php';
require_once '../../../includes/utils_inc.php';

dump($_GET);

if (!empty($_GET['id']) && !empty($_GET['page_name'])) {
    $pageName = $_GET['page_name'];
    $array = $_GET['id'];
    $explode = explode("-", $array);
    $menuLevel = $explode[0];
    $id = $explode[1];

    $page = new Page();
    $page->removeFromMenu($menuLevel, $id, $pageName);
}
header('Location: ' . HOST . 'admin/cms-menu');