<?php

function connectDB(): PDO
{
    $pdo = new PDO('mysql:host=localhost;port=3308;dbname=blogphp;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function getPosts(): array
{
    $pdo = connectDB();

    $request = $pdo->query('SELECT p.*, u.name FROM posts p LEFT JOIN users u ON p.id_user = u.id');
    $articles = $request->fetchAll();
    return $articles;
}

function createPost(string $title, string $content, string $resume)
{
    $pdo = connectDB();
    $request = $pdo->prepare('INSERT INTO posts (title, content, resume, date) VALUES (?,?,?,NOW())');
    $request->execute([$title, $content, $resume]);
}
