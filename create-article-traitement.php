<?php
$message = 'Merci de saisir complètement le formulaire !';
$title = trim($_POST['title']);
$resume = trim($_POST['resume']);
$content = trim($_POST['content']);

if (strlen($title) < 3 || strlen($resume) < 3 || strlen($content) < 10) {
    header('Location: create-article.php?error=true&message=' . urlencode($message));
} else {
    // Enregistrement dans la BDD
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    $pdo = new PDO('mysql:host=localhost;port=3308;dbname=blogphp;charset=utf8', 'root', '');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $request = $pdo->prepare('INSERT INTO posts (title, content, resume, date) VALUES (?,?,?,NOW())');
    $request->execute([$title, $content, $resume]);

    header('Location: admin-posts.php');
}
