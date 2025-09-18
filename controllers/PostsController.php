<?php

require_once 'models\PostsManager.php';
require_once 'models\CommentsManager.php';

class PostsController

{
    public function home()
    {
        $postsManager = new PostsManager();
        $articles = $postsManager->getPosts();
        require 'views\home.php';
    }

    public function post()
    {
        if (!isset($_GET['id'])) {
            header('Location: index.php?page=home');
            exit;
        }

        $id = intval($_GET['id']);

        $postsManager = new PostsManager();
        $article = $postsManager->getPost($id);
        $commentsManager = new CommentsManager();
        $comments = $commentsManager->getComments($id);
        $tags = $postsManager->getTagsPost($id);
        require 'views\article.php';
    }

    public function comment()
    {
        if (!isset($_GET['id'])) {
            header('Location: index.php?page=home');
            exit;
        }
        $author = trim($_POST['author']);
        $content = trim($_POST['content']);
        $idPost = intval($_GET['id']);

        $commentsManager = new CommentsManager();

        if (!$author || !$content) {
            header('Location: index.php?page=post&id=' . $idPost);
        } else if ($commentsManager->createComment($author, $content, $idPost)) {

            header("Location: index.php?page=post&id=" . $idPost . "&success=1");
            exit;
        } else {
            $error = "Impossible d'enregistrer le commentaire.";
        }
    }
}
