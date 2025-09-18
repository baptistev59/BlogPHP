<?php

require_once 'models\Comment.php';

class CommentsManager
{

    private function connectDB(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=blogphp;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getComments(int $idPost)
    {
        $pdo = $this->connectDB();

        $sql = "SELECT * FROM comments WHERE post_id = :post_id";
        $params = [
            ':post_id' => $idPost
        ];

        $request = $pdo->prepare($sql);
        $request->execute($params);
        $results = $request->fetchAll();

        $comments = [];

        foreach ($results as $comment) {
            $comments[] = new Comment($comment);
        }

        return $comments;
    }
    public function createComment(string $author, string $content, int $idPost)
    {
        try {
            $pdo = $this->connectDB();

            $sql = "INSERT INTO comments (content, author, date, post_id) VALUES (:content, :author, NOW(), :post_id)";
            $params = [
                ':content' => $content,
                ':author' => $author,
                ':post_id' => $idPost
            ];

            $request = $pdo->prepare($sql);
            return $request->execute($params);
        } catch (PDOException $error) {
            error_log("Erreur CreateComment :" . $error->getMessage());
            return false;
        }
    }
}
