<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil - MyBlog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <header class="bg-white shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.php?page=home" class="text-2xl font-bold text-indigo-600">MyBlog</a>
            <nav class="space-x-6">
                <a href="index.php?page=home" class="text-gray-700 hover:text-indigo-600">Accueil</a>
                <?php
                echo !isset($_SESSION['user_id'])
                    ? '<a href="index.php?page=login" class="text-gray-700 hover:text-indigo-600">Connexion</a> 
           <a href="index.php?page=register" class="text-gray-700 hover:text-indigo-600">Créer un compte</a>'
                    : '<a href="index.php?page=logout" class="text-gray-700 hover:text-indigo-600">Déconnexion</a>
           <a href="index.php?page=admin" class="text-gray-700 hover:text-indigo-600">Admin</a>';
                ?>
            </nav>
        </div>
    </header>