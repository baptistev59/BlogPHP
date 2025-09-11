<?php

require 'models\posts.models.php';

class PostsController
{
    public function home()
    {
        $articles = getPosts();
        require 'views\home.php';
    }

    public function post()
    {
        require 'views\article.php';
    }
}
