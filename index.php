<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require 'controllers\admin.controller.php';
require 'controllers\posts.controller.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        home();
        break;

    case 'admin':
        admin();
        break;

    case 'create-post':
        adminCreatePost();
        break;

    case 'create-post-valid':
        adminCreatePostValid();
        break;

    case 'admin-posts':
        adminPosts();
        break;

    default:
        home();
        break;
}
