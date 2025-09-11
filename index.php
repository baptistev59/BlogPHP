<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$pdo = new PDO('mysql:host=localhost;port=3308;dbname=blogphp;charset=utf8', 'root', '');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$request = $pdo->query('SELECT p.*, u.name FROM posts p LEFT JOIN users u ON p.id_user = u.id');
$articles = $request->fetchAll();
?>

<?php include 'header.php' ?>
<main class="max-w-6xl mx-auto px-4 py-10 grow">
  <h1 class="text-3xl font-bold mb-8">Derniers articles</h1>
  <div class="grid md:grid-cols-3 gap-8">
    <!-- début article -->
    <?php
    foreach ($articles as $article) {
    ?>
      <article class="bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold mb-2"><a href="article.php" class="hover:text-indigo-600"><?php echo $article['title']; ?></a></h2>
        <p class="text-gray-600 mb-4"><?php echo $article['resume']; ?></p>
        <div class="flex justify-between text-sm text-gray-500">
          <span>Par <?php echo $article['name']; ?></span>
          <span><?php echo date('d/m/Y', strtotime($article['date'])); ?></span>
        </div>
      </article>
    <?php } ?>
    <!-- fin article -->
  </div>

</main>
<?php include 'footer.php' ?>