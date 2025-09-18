<?php

require_once 'models\Post.php';
require_once 'models\Tag.php';

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

    public function getAllTags(): array
    {
        $pdo = $this->connectDB();

        $sql = "SELECT * FROM tags ORDER BY name ASC";
        $request = $pdo->query($sql);

        $tags = [];
        foreach ($request->fetchAll() as $tag) {
            $tags[] = new Tag($tag);
        }

        return $tags;
    }

    public function getTagsPost(int $idPost): array
    {
        $pdo = $this->connectDB();

        $sql = "SELECT t.*
            FROM post_tags pt
            LEFT JOIN tags t ON pt.tag_id = t.id
            WHERE pt.post_id = :post_id";

        $params = [
            ':post_id' => $idPost
        ];

        $request = $pdo->prepare($sql);
        $request->execute($params);

        $tags = [];
        foreach ($request->fetchAll(PDO::FETCH_ASSOC) as $tag) {
            $tags[] = new Tag($tag);
        }

        return $tags;
    }

    public function createPost(string $title, string $content, string $resume, ?string $image, ?array $tags)
    {
        $pdo = $this->connectDB();

        $sql = "INSERT INTO posts (title, content, resume, date, user_id, image) VALUES (:title,:content,:resume,NOW(),:user_id,:image)";
        $params = [
            ':title' => $title,
            ':content' => $content,
            ':resume' => $resume,
            ':user_id' => $_SESSION['user_id'],
            ':image' => $image
        ];

        $request = $pdo->prepare($sql);
        $request->execute($params);

        $idPost = $pdo->lastInsertId();

        foreach ($tags as $tag) {

            $sql = "INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)";
            $params = [
                ':post_id' => $idPost,
                ':tag_id' => $tag
            ];

            $request = $pdo->prepare($sql);
            $request->execute($params);
        }
    }

    public function deletePost(int $id)
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare('DELETE FROM posts WHERE id = ?');
        $request->execute([$id]);

        // On supprime les anciens tags liés à ce post
        $sqlDelete = "DELETE FROM post_tags WHERE post_id = :post_id";
        $request = $pdo->prepare($sqlDelete);
        $request->execute([':post_id' => $id]);
    }

    public function updatePost(string $title, string $content, string $resume, ?string $image, int $idPost, array $tags)
    {
        $pdo = $this->connectDB();

        if (!empty($image)) {
            $sql = "UPDATE posts 
                SET title = :title, resume = :resume, content = :content, image = :image
                WHERE id = :id";
            $params = [
                ':title' => $title,
                ':resume' => $resume,
                ':content' => $content,
                ':image' => $image,
                ':id' => $idPost
            ];
        } else {
            $sql = "UPDATE posts 
                SET title = :title, resume = :resume, content = :content
                WHERE id = :id";
            $params = [
                ':title' => $title,
                ':resume' => $resume,
                ':content' => $content,
                ':id' => $idPost
            ];
        }

        $request = $pdo->prepare($sql);
        $request->execute($params);

        // Mise à jour des tags
        // On supprime les anciens tags liés à ce post
        $sqlDelete = "DELETE FROM post_tags WHERE post_id = :post_id";
        $request = $pdo->prepare($sqlDelete);
        $request->execute([':post_id' => $idPost]);

        // On insère les nouveaux tags
        $sqlInsert = "INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)";
        $request = $pdo->prepare($sqlInsert);

        foreach ($tags as $tagId) {
            $request->execute([
                ':post_id' => $idPost,
                ':tag_id'  => $tagId
            ]);
        }
    }

    public function deleteTag(int $id)
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare('DELETE FROM tags WHERE id = ?');
        $request->execute([$id]);
    }

    public function deletePostTags(int $id)
    {
        $pdo = $this->connectDB();

        $request = $pdo->prepare('DELETE FROM post_tags WHERE post_id = ?');
        $request->execute([$id]);
    }
    public function countPostsByTag(int $tagId): int
    {
        try {
            $pdo = $this->connectDB();
            $sql = "SELECT COUNT(*) as total FROM post_tags WHERE tag_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$tagId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) $result['total'];
        } catch (PDOException $e) {
            error_log("Erreur countPostsByTag :" . $e->getMessage());
            return 0;
        }
    }
}
