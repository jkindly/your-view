<?php
require_once '../../../model/cms/Page.php';

$id = $_GET['id'];

$page = new Page();

$page->remove($id);

header('Location: ' . HOST . 'admin/cms-manage-pages');