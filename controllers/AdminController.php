<?php

class AdminController
{
    public function admin()
    {
        require 'views\admin.php';
    }

    public function adminCreatePost()
    {
        require 'views\create-article.php';
    }

    public function adminPosts()
    {
        require 'views\admin-posts.php';
    }

    public function adminCreatePostValid()
    {
        $message = 'Merci de saisir complètement le formulaire !';
        $title = trim($_POST['title']);
        $resume = trim($_POST['resume']);
        $content = trim($_POST['content']);

        if (strlen($title) < 3 || strlen($resume) < 3 || strlen($content) < 10) {
            header('Location: index.php?page=create-post&error=true&message=' . urlencode($message));
        } else {
            header('Location: index.php?page=admin-posts');
        }
    }
}
