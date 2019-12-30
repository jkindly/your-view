<?php
require DIR_PATH . DS . 'model' . DS . 'User.php';
if (session_status() == PHP_SESSION_NONE)
    session_start();
if (isset($_SESSION['id'])) {
    $user = new User();
    $user->getUser($_SESSION['id']);
}

?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/752157b47f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/your-view/public/css/main.css">
    <link rel="stylesheet" href="http://localhost/your-view/public/css/croppie.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://localhost/your-view/public/js/main.js"></script>
    <title></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand brand" href="<?= HOST ?>">Your view</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mr-3">
            <li class="nav-item active">
                <a class="nav-link" href="<?= HOST ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Ranking</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kategorie
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
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