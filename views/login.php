<?php include 'header.php' ?>
<main class="max-w-6xl mx-auto px-4 py-10 grow">
  <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md mx-auto my-12">
    <h1 class="text-2xl font-bold mb-6">Connexion</h1>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'credentials'): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-3">
        Votre mot de passe ou votre email n'est pas reconnu !
      </div>
    <?php endif; ?>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'fields'): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-3">
        Veuillez saisir votre email et votre mot de passe !
      </div>
    <?php endif; ?>
    <form class="space-y-4" action="index.php?page=login-valid" method="post">
      <input type="email" name='email' placeholder="Email" class="w-full border rounded-lg p-3">
      <input type="password" name="password" placeholder="Mot de passe" class="w-full border rounded-lg p-3">
      <button class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">Se connecter</button>
    </form>
    <p class="mt-4 text-sm text-gray-500">Pas encore de compte ? <a href="register.php" class="text-indigo-600 hover:underline">Créer un compte</a></p>
  </div>
</main>
<?php include 'footer.php' ?>