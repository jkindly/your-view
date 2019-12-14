<?php
require 'Model.php';
require '../includes/utils_inc.php';

class User extends Model {
    private $login;
    private $password;

    public function __construct($login, $password)
    {
        parent::__construct();
        $this->login = $login;
        $this->password = $password;
    }

    public function login() {
        $query = $this->pdo->prepare('SELECT * FROM user WHERE login = :login;');
        $query->bindValue(':login', $this->login, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $checkPassword = password_verify($this->password, $result['password']);

            if ($checkPassword) {
                session_start();
                $_SESSION['id'] = $result['id'];
                $_SESSION['login'] = $result['login'];
                header('Location: http://localhost/your-view/');
            }
            else
                //todo add header
                echo 'wrong';
        }







    }
}
