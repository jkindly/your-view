<?php
require_once '../../model/cms/Page.php';

if (!isset($_POST['page_name']) || empty($_POST['page_name'])) {
    $_SESSION['createPageError'] = 'Wprowadź nazwę strony!';
    header('Location: ' . HOST . 'admin/cms-new-page');
}

if (!isset($_POST['page_uri']) || empty($_POST['page_uri'])) {
    $_SESSION['createPageError'] = 'Wprowadź adres URI strony!';
    header('Location: ' . HOST . 'admin/cms-new-page');
}

$name       = $_POST['page_name'];
$uri        = $_POST['page_uri'];
$metaTitle  = !empty($_POST['meta_title']) ? $_POST['meta_title'] : null;
$metaDesc   = !empty($_POST['meta_title']) ? $_POST['meta_desc'] : null;
$metaRobots = $_POST['meta_robots'];
$content    = !empty($_POST['page_content']) ? $_POST['page_content'] : null;

$page = new Page();
$page->setName($name)
     ->setUri($uri)
     ->setMetaTitle($metaTitle)
     ->setMetaDesc($metaDesc)
     ->setMetaRobots($metaRobots)
     ->setContent($content);

if (isset($_POST['page_id'])) {
    if ($page->uriExists() && $page->uriExistsOnEdit($_POST['page_id'])) {
        $page->edit($_POST['page_id']);
        $_SESSION['newPageAddress'] = HOST . $page->getUri();
        $_SESSION['editPageSuccess'] = 'Pomyślnie edytowano stronę';
        header('Location: '. HOST . 'admin/cms-edit-page?id='.$_POST['page_id']);
    } elseif ($page->uriExists() && !$page->uriExistsOnEdit($_POST['page_id'])) {
        $_SESSION['createPageError'] = 'Podany adres URI już istnieje!';
        header('Location: ' . HOST . 'admin/cms-eidt-page?id='.$_POST['page_id']);
    } else {
        $page->edit($_POST['page_id']);
        $_SESSION['newPageAddress'] = HOST . $page->getUri();
        $_SESSION['editPageSuccess'] = 'Pomyślnie edytowano stronę';
        header('Location: '. HOST . 'admin/cms-edit-page?id='.$_POST['page_id']);
    }
} else {
    if ($page->uriExists()) {
        $_SESSION['saved_page_name'] = $name;
        $_SESSION['saved_page_uri'] = $uri;
        $_SESSION['saved_meta_title'] = $metaTitle;
        $_SESSION['saved_meta_desc'] = $metaDesc;
        $_SESSION['saved_meta_robots'] = $metaRobots;
        $_SESSION['saved_content'] = $content;
        $_SESSION['createPageError'] = 'Podany adres URI już istnieje!';
        header('Location: ' . HOST . 'admin/cms-new-page');
    } else {
        $page->create();
        $_SESSION['createPageSuccess'] = 'Pomyślnie utworzono stronę';
        $_SESSION['newPageAddress'] = HOST . $page->getUri();
        unset($_SESSION['saved_page_name']);
        unset($_SESSION['saved_page_uri']);
        unset($_SESSION['saved_meta_title']);
        unset($_SESSION['saved_meta_desc']);
        unset($_SESSION['saved_meta_robots']);
        unset($_SESSION['saved_content']);
        header('Location: ' . HOST . 'admin/cms-new-page');
    }

}

