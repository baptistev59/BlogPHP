<?php

require_once 'models\PostsManager.php';

class AdminController
{
    public function deletePost()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        if (!isset($_GET['id'])) {
            header('Location: index.php?page=home');
            exit;
        }
        $id = $_GET['id'];
        $postsManager = new PostsManager();
        $postsManager->deletePost($id);
        header('Location: index.php?page=admin-posts');
    }

    public function updatePost()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        if (!isset($_GET['id'])) {
            header('Location: index.php?page=home');
            exit;
        }
        $id = $_GET['id'];
        $postsManager = new PostsManager();
        $article = $postsManager->getPost($id);
        require 'views\update-article.php';
    }

    public function admin()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        require 'views\admin.php';
    }

    public function adminCreatePost()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        require 'views\create-article.php';
    }

    public function adminPosts()
    {
        if (!isset($_SESSION['user_id'])) {

            header('Location: index.php?page=login');
            exit;
        }
        $postsManager = new PostsManager();
        $articles = $postsManager->getPosts();
        require 'views\admin-posts.php';
    }

    public function adminCreatePostValid()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        $title = trim($_POST['title']);
        $resume = trim($_POST['resume']);
        $content = trim($_POST['content']);
        $newFileName = null;


        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = basename($_FILES['image']['name']);
            $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!getimagesize($fileTmpPath)) {
                header('Location: index.php?page=create-post&error=notimage');
                exit;
            } else if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                header('Location: index.php?page=create-post&error=size');
                exit;
            } else if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                header('Location: index.php?page=create-post&error=type');
                exit;
            } else {
                $newFileName = uniqid('img_', true) . '.' . $imageFileType;
                move_uploaded_file($fileTmpPath, $uploadDir . $newFileName);
            }
        }

        if (strlen($title) < 3 || strlen($resume) < 3 || strlen($content) < 10) {
            header('Location: index.php?page=create-post&error=validation');
        } else {
            $postsManager = new PostsManager();
            $postsManager->createPost($title, $content, $resume, $newFileName ?? null);
            header('Location: index.php?page=home');
            exit;
        }
    }

    public function updatePostValid()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        if (!isset($_GET['id'])) {
            header('Location: index.php?page=home');
            exit;
        }

        $id = intval($_GET['id']);
        $title = trim($_POST['title']);
        $resume = trim($_POST['resume']);
        $content = trim($_POST['content']);

        $postsManager = new PostsManager();
        $post = $postsManager->getPost($id);
        $oldFileName = $post->getImage();
        $newFileName = $oldFileName; // par défaut on garde l'ancienne image

        // Vérif si un nouveau fichier est uploadé
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = basename($_FILES['image']['name']);
            $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!getimagesize($fileTmpPath)) {
                header('Location: index.php?page=update-post&id=' . $id . '&error=notimage');
                exit;
            } elseif ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                header('Location: index.php?page=update-post&id=' . $id . '&error=size');
                exit;
            } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                header('Location: index.php?page=update-post&id=' . $id . '&error=type');
                exit;
            } else {
                $newFileName = uniqid('img_', true) . '.' . $imageFileType;
                if (move_uploaded_file($fileTmpPath, $uploadDir . $newFileName)) {
                    // Supprimer l'ancienne image si elle existe
                    if (!empty($oldFileName) && file_exists($uploadDir . $oldFileName)) {
                        unlink($uploadDir . $oldFileName);
                    }
                }
            }
        }

        if (strlen($title) < 3 || strlen($resume) < 3 || strlen($content) < 10) {
            header('Location: index.php?page=update-post&id=' . $id . '&error=validation');
            exit;
        }

        // Mise à jour en base
        // var_dump($newFileName);
        // exit;
        $postsManager->updatePost($title, $content, $resume, $newFileName, $id);

        header('Location: index.php?page=home');
        exit;
    }


    private function isLoged()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
    }
}
