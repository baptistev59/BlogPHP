<?php include 'header.php' ?>
<main class="max-w-6xl mx-auto px-4 py-10 grow">
  <h1 class="text-3xl font-bold mb-6">Modifier l'article</h1>
  <?php if (isset($_GET['error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-3">
      <?= isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '' ?>
    </div>
  <?php endif; ?>
  <form class="bg-white p-6 rounded-lg shadow space-y-4" method="post" action="index.php?page=update-post-valid&id=<?php echo $article->getId(); ?>" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Titre de l’article" class="w-full border rounded-lg p-3" value="<?php echo $article->getTitle(); ?>">
    <?php if ($article->getImage()) { ?>
      <img class="rounded-lg mb-4" alt="<?php echo $article->getTitle(); ?>" src="uploads/<?php echo $article->getImage(); ?>" />
    <?php } ?>
    <label for="image">Modifier l'image</label>
    <input type="file" name="image" id="image" placeholder="Image de l'article" class="w-full border rounded-lg p-3" accept="image/* ">
    <textarea name="resume" placeholder="Résumé de l’article" class="w-full border rounded-lg p-3 h-20"><?php echo $article->getResume(); ?></textarea>
    <textarea name="content" placeholder="Contenu de l’article" class="w-full border rounded-lg p-3 h-40"><?php echo $article->getContent(); ?></textarea>
    <div class="grid grid-cols-3 gap-4">
      <label class="flex items-center space-x-2">
        <input type="checkbox" name="tags" value="tech" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span>Tech</span>
      </label>
      <label class="flex items-center space-x-2">
        <input type="checkbox" name="tags" value="design" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span>Design</span>
      </label>
      <label class="flex items-center space-x-2">
        <input type="checkbox" name="tags" value="javascript" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span>JavaScript</span>
      </label>
      <label class="flex items-center space-x-2">
        <input type="checkbox" name="tags" value="tailwind" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span>Tailwind</span>
      </label>
      <label class="flex items-center space-x-2">
        <input type="checkbox" name="tags" value="php" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span>PHP</span>
      </label>
      <label class="flex items-center space-x-2">
        <input type="checkbox" name="tags" value="html" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <span>HTML</span>
      </label>
    </div>
    <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Publier</button>
  </form>
</main>
<?php include 'footer.php' ?>