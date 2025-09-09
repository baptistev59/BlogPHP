<?php
$message = 'Merci de saisir complètement le formulaire !';
$title = trim($_POST['title']);
$resume = trim($_POST['resume']);
$content = trim($_POST['content']);

if (strlen($title) < 3 || strlen($resume) < 3 || strlen($content) < 10) {
    header('Location: create-article.php?error=true&message=' . urlencode($message));
} else {
    // Enregistrement dans la BDD
    header('Location: admin-posts.php');
}
