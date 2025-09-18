<?php

require_once 'models\Tag.php';

class TagsManager
{
    private function connectDB(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=blogphp;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function getTags(): array | bool
    {
        try {
            $pdo = $this->connectDB();
            $request = $pdo->query('SELECT * FROM tags');

            $tags = [];
            foreach ($request->fetchAll() as $tag) {
                $tags[] = new Tag($tag);
            }

            return $tags;
        } catch (PDOException $error) {
            error_log("Erreur getTags :" . $error->getMessage());
            return false;
        }
    }

    public function getTagById(int $id)
    {
        try {
            $pdo = $this->connectDB();
            $sql = 'SELECT * FROM tags WHERE id = :id';
            $request = $pdo->prepare($sql);
            $request->execute([':id' => $id]);

            $tag = $request->fetch(PDO::FETCH_ASSOC);

            return $tag ?: null;
        } catch (PDOException $error) {
            error_log("Erreur getTagById :" . $error->getMessage());
            return null;
        }
    }

    public function createTag(string $name)
    {
        try {
            $pdo = $this->connectDB();

            $sql = "INSERT INTO tags (name) VALUES (:name)";
            $params = [
                ':name' => $name
            ];

            $request = $pdo->prepare($sql);
            $request->execute($params);
        } catch (PDOException $error) {
            error_log("Erreur CreateTag :" . $error->getMessage());
            return false;
        }
    }

    public function deleteTag(int $id)
    {
        try {
            $pdo = $this->connectDB();

            $sql = 'DELETE FROM tags WHERE id = :id';
            $params = [
                ':id' => $id
            ];

            $request = $pdo->prepare($sql);
            $request->execute($params);
        } catch (PDOException $error) {
            error_log("Erreur deleteTag :" . $error->getMessage());
            return false;
        }
    }

    public function updateTag(string $name, int $id)
    {
        try {
            $pdo = $this->connectDB();

            $sql = "UPDATE tags 
                SET name = :name
                WHERE id = :id";
            $params = [
                ':name' => $name,
                ':id' => $id
            ];

            $request = $pdo->prepare($sql);
            $request->execute($params);
        } catch (PDOException $error) {
            error_log("Erreur updateTag :" . $error->getMessage());
            return false;
        }
    }
}
