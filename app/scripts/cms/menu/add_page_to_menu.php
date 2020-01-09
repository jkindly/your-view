<?php
require_once '../../../model/cms/Page.php';
require_once '../../../model/cms/Menu.php';
require_once '../../../includes/utils_inc.php';

dump($_POST);

if (!empty($_POST['check_list'])) {
    foreach ($_POST['check_list'] as $item) {
        $explode = explode(":", $item);
        $page = new Page();
        $page->addToMenu($explode[0], $explode[1], $explode[2]);
    }
}
header('Location: ' . HOST . 'admin/cms-menu');