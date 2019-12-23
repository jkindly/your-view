<?php
require 'Model.php';
require '../includes/utils_inc.php';

class User extends Model {
    private $login;
    private $password;
    private $firstName;
    private $avatar;

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
            session_start();
            if ($checkPassword) {
                unset($_SESSION['loginFailed']);
                $_SESSION['id'] = $result['id'];
                $_SESSION['login'] = $result['login'];
                $this->firstName = $result['first_name'];
                header('Location: ' . HOST);
            }
            else
                $_SESSION['loginFailed'] = true;
                header('Location: ' . HOST . 'login');
        }
        $_SESSION['loginFailed'] = true;
        header('Location: ' . HOST . 'login');
    }

    public function getFirstName() {
        return $this->firstName;
    }
}
