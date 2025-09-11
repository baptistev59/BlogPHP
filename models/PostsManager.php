<?php

require 'models\Post.php';

class PostsManager
{
    private function connectDB(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;port=3308;dbname=blogphp;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getPosts(): array
    {
        $pdo = $this->connectDB();

        $request = $pdo->query('SELECT p.*, u.name FROM posts p LEFT JOIN users u ON p.id_user = u.id');
        $articles = $request->fetchAll();

        $posts = [];
        foreach ($articles as $article) {
            $posts[] = new Post($article);
        }

        return $posts;
    }

    public function createPost(string $title, string $content, string $resume)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare('INSERT INTO posts (title, content, resume, date) VALUES (?,?,?,NOW())');
        $request->execute([$title, $content, $resume]);
    }
}
