<?php

require 'models\User.php';

class UsersManager
{

    private function connectDB(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;port=3308;dbname=blogphp;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function emailAlreadyExits(string $email): bool
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $request->execute([$email]);
        $user = $request->fetch();
        return (!$user) ? false : true;
    }

    public function register(string $name, string $email, string $password)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare('INSERT INTO users (name,email,password) VALUES (?,?,?)');
        $request->execute([$name, $email, $password]);
    }

    public function getUser(string $email): User|null
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $request->execute([$email]);
        $user = $request->fetch();
        return ($user) ? new User($user) : null;
    }
}
