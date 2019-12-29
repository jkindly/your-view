<?php
require 'Model.php';
require_once DIR_PATH.DS.'includes'.DS.'utils_inc.php';

class User extends Model {
    private $login;
    private $password;
    private $firstName;
    private $avatar;
    private $role;

    public function login() {
        $query = $this->pdo->prepare('SELECT * FROM user WHERE login = :login;');
        $query->bindValue(':login', $this->login, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $checkPassword = password_verify($this->password, $result['password']);
            if (session_status() == PHP_SESSION_NONE)
                session_start();
            if ($checkPassword) {
                unset($_SESSION['loginFailed']);

                $_SESSION['id'] = $result['id'];
            }
            else
                $_SESSION['loginFailed'] = true;
                header('Location: ' . HOST . 'login');
        }
        $_SESSION['loginFailed'] = true;
        header('Location: ' . HOST . 'login');
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getUser($id) {
        $query = $this->pdo->prepare('SELECT first_name, avatar_src, role FROM user WHERE id = :id;');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->firstName = $result['first_name'];
            $this->avatar = $result['avatar_src'];
            $this->role = $result['role'];
        }
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function getRole() {
        return $this->role;
    }
}
