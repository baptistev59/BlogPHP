<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require 'controllers\AdminController.php';
require 'controllers\PostsController.php';
require 'controllers\UsersController.php';

$page = $_GET['page'] ?? 'home';
$adminController = new AdminController();
$postsController = new PostsController();
$usersController = new UsersController();

switch ($page) {
    case 'home':
        $postsController->home();
        break;

    case 'admin':
        $adminController->admin();
        break;

    case 'create-post':
        $adminController->adminCreatePost();
        break;

    case 'create-post-valid':
        $adminController->adminCreatePostValid();
        break;

    case 'admin-posts':
        $adminController->adminPosts();
        break;

    case 'register':
        $usersController->register();
        break;

    case 'register-valid':
        $usersController->registerValid();
        break;

    case 'login':
        $usersController->login();
        break;

    case 'login-valid':
        $usersController->loginValid();
        break;

    case 'logout':
        $usersController->logout();
        break;

    default:
        $postsController->home();
        break;
}
