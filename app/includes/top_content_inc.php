<?php
require_once DIR_PATH . DS . 'model' . DS . 'User.php';
require_once DIR_PATH . DS . 'model' . DS . 'cms' . DS . 'Menu.php';
if (session_status() == PHP_SESSION_NONE)
    session_start();
if (isset($_SESSION['id'])) {
    $user = new User();
    $user->getUser($_SESSION['id']);
}

$menu = new Menu();
$menuList = $menu->getMenuLevel1();

?>
<!doctype html>
<html lang="pl">
<?php
include_once dirname(__FILE__).'/../includes/header.phtml';
?>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand brand" href="<?= HOST ?>">Your view</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mr-3">
            <?php foreach ($menuList as $menuItem): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= HOST ?><?= $menuItem->getUri() ?>"> <?= $menuItem->getName() ?></a>
                </li>
            <?php endforeach; ?>
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="--><?//= HOST ?><!--">Home <span class="sr-only">(current)</span></a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="#">Ranking</a>-->
<!--            </li>-->
<!--            <li class="nav-item dropdown">-->
<!--                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                    Kategorie-->
<!--                </a>-->
<!--                <div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
<!--                    <a class="dropdown-item" href="#">Action</a>-->
<!--                    <a class="dropdown-item" href="#">Another action</a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item" href="#">Something else here</a>-->
<!--                </div>-->
<!--            </li>-->
        </ul>
        <form class="form-inline my-2 my-lg-0 top-search-form">
            <input class="form-control mr-sm-2" type="search" placeholder="Wyszukaj..." aria-label="Wyszukaj">
            <button class="search-btn"><i class="fas fa-search"></i></button>
        </form>
        <?php
            if (isset($_SESSION['id'])) include 'logged_in_top_content_inc.php';
            else include 'not_logged_in_top_content_inc.php';
        ?>
    </div>
</nav>
<div id="main">