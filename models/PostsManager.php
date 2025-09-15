<?php

require_once 'models\Post.php';

class PostsManager
{
    private function connectDB(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=blogphp;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getPosts(): array
    {
        $pdo = $this->connectDB();

        $request = $pdo->query('SELECT p.*, u.name FROM posts p LEFT JOIN users u ON p.user_id = u.id');
        $articles = $request->fetchAll();

        $posts = [];
        foreach ($articles as $article) {
            $posts[] = new Post($article);
        }

        return $posts;
    }

    public function getPost(int $id): Post | null
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $request->execute([$id]);
        $article = $request->fetch();

        if (!$article)
            return null;
        return new Post($article);
    }

    public function createPost(string $title, string $content, string $resume, ?string $image)
    {
        $pdo = $this->connectDB();
        $request = $pdo->prepare('INSERT INTO posts (title, content, resume, date, user_id, image) VALUES (?,?,?,NOW(),?,?)');
        $request->execute([$title, $content, $resume, $_SESSION['user_id'], $image]);
    }

    public function deletePost(int $id)
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare('DELETE FROM posts WHERE id = ?');
        $request->execute([$id]);
    }

    public function updatePost($title, $content, $resume, $image, $id)
    {
        $db = $this->connectDB();

        if (!empty($image)) {
            $sql = "UPDATE posts 
                SET title = :title, resume = :resume, content = :content, image = :image 
                WHERE id = :id";
            $params = [
                ':title' => $title,
                ':resume' => $resume,
                ':content' => $content,
                ':image' => $image,
                ':id' => $id
            ];
        } else {
            $sql = "UPDATE posts 
                SET title = :title, resume = :resume, content = :content 
                WHERE id = :id";
            $params = [
                ':title' => $title,
                ':resume' => $resume,
                ':content' => $content,
                ':id' => $id
            ];
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
    }
}
