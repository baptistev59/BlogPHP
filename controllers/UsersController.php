<?php
require 'models\UsersManager.php';

class UsersController
{
    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php?page=home');
    }

    public function login()
    {
        require 'views\login.php';
    }

    public function loginValid()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $usersManager = new UsersManager();

        if (!$email || !$password) {
            header('Location: index.php?page=login&error=fields');
        } else {
            $user = $usersManager->getUser($email);
            if (!$user) {
                header('Location: index.php?page=login&error=credentials');
            } else if (!password_verify($password, $user->getPassword())) {
                header('Location: index.php?page=login&error=credentials');
            } else {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_name'] = $user->getName();
                header('Location: index.php?page=login');
            }
        }
    }

    public function register()
    {
        require 'views\register.php';
    }

    public function registerValid()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $usersManager = new UsersManager();

        if (!$name || !$email || !$password) {
            header('Location: index.php?page=register&error=fields');
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?page=register&error=email-format');
        } else if ($usersManager->emailAlreadyExits($email)) {
            header('Location: index.php?page=register&error=email-used');
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $usersManager->register($name, $email, $password);
            header('Location: index.php?page=login');
        }
    }
}
