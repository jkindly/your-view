<?php

//include $_SERVER['DOCUMENT_ROOT'].'/your-view/app/config/defines.php';

class Model {
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            echo 'Wystąpił błąd połączenia z bazą. Kod błędu: ' . $e->getCode();
        }
    }
}