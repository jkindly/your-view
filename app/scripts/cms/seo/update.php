<?php
require_once '../../../model/cms/Seo.php';

if (isset($_POST['def_meta_title'])) {
    $seo = new Seo();

    $seo->setDefaultMetaTitle($_POST['def_meta_title']);
    $seo->updateDefaultMetaTitle();
}

header('Location: ' . HOST . 'admin/cms-seo');