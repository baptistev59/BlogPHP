<?php
$articles = [
  [
    'title' => 'Titre de l’article 1',
    'descript' => 'Petit résumé du premier article pour donner envie de cliquer...',
    'author' => 'Admin',
    'date' => '12/08/2025'
  ],
  [
    'title' => 'Titre de l’article 2',
    'descript' => 'Petit résumé du deuxième article pour donner envie de cliquer...',
    'author' => 'Bapt',
    'date' => '13/08/2025'
  ],
  [
    'title' => 'Titre de l’article 3',
    'descript' => 'Petit résumé du troisième article pour donner envie de cliquer...',
    'author' => 'Tom',
    'date' => '14/08/2025'
  ]
]
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
        <h2 class="text-xl font-semibold mb-2"><a href="article.html" class="hover:text-indigo-600"><?php echo $article['title']; ?></a></h2>
        <p class="text-gray-600 mb-4"><?php echo $article['descript']; ?></p>
        <div class="flex justify-between text-sm text-gray-500">
          <span>Par <?php echo $article['author']; ?></span>
          <span><?php echo $article['date']; ?></span>
        </div>
      </article>
    <?php } ?>
    <!-- fin article -->
  </div>

</main>
<?php include 'footer.php' ?>