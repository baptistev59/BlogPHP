<?php include 'header.php' ?>
<main class="max-w-6xl mx-auto px-4 py-10 grow">
  <h1 class="text-3xl font-bold mb-8">Derniers articles</h1>
  <div class="grid md:grid-cols-3 gap-8">
    <!-- début article -->
    <?php
    foreach ($articles as $article) {
    ?>
      <article class="bg-white shadow rounded-xl p-6">
        <?php if ($article->getImage()) { ?>
          <img class="rounded-lg mb-4" alt="<?php echo $article->getTitle(); ?>" src="uploads/<?php echo $article->getImage(); ?>" />
        <?php } ?>

        <h2 class="text-xl font-semibold mb-2"><a href="article.php" class="hover:text-indigo-600"><?php echo $article->getTitle(); ?></a></h2>
        <p class="text-gray-600 mb-4"><?php echo $article->getResume(); ?></p>
        <div class="flex justify-between text-sm text-gray-500">
          <span>Par <?php echo $article->getNameUser(); ?></span>
          <span><?php echo date('d/m/Y', strtotime($article->getDate())); ?></span>
        </div>
      </article>
    <?php } ?>
    <!-- fin article -->
  </div>

</main>
<?php include 'footer.php' ?>