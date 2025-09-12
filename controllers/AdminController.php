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
        $title = trim($_POST['title']);
        $resume = trim($_POST['resume']);
        $content = trim($_POST['content']);

        if (strlen($title) < 3 || strlen($resume) < 3 || strlen($content) < 10) {
            header('Location: index.php?page=create-post&error=true');
        } else {
            header('Location: index.php?page=admin-posts');
        }
    }
}
