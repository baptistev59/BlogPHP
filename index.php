<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'controllers\AdminController.php';
require_once 'controllers\PostsController.php';
require_once 'controllers\UsersController.php';

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

    case 'admin-tags':
        $adminController->adminTags();
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

    case 'delete-post':
        $adminController->deletePost();
        break;

    case 'delete-tag':
        $adminController->deleteTag();
        break;

    case 'update-post':
        $adminController->updatePost();
        break;

    case 'update-tag':
        $adminController->updateTag();
        break;

    case 'update-post-valid':
        $adminController->updatePostValid();
        break;

    case 'update-tag-valid':
        $adminController->updateTagValid();
        break;

    case 'post':
        $postsController->post();
        break;

    case 'comment':
        $postsController->comment();
        break;


    case 'create-tag':
        $adminController->createTag();
        break;

    default:
        $postsController->home();
        break;
}
