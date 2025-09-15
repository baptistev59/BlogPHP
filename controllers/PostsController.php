<?php

require_once 'models\PostsManager.php';

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
        require 'views\article.php';
    }
}
