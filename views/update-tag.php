<?php include 'header.php' ?>
<main class="max-w-6xl mx-auto px-4 py-10 grow">
  <h1 class="text-3xl font-bold mb-6 min-w-[700px]">Modifier le tag</h1>
  <?php if (isset($_GET['error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-3">
      <?= isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '' ?>
    </div>
  <?php endif; ?>
  <form class="bg-white p-6 rounded-lg shadow space-y-4"
    method="post"
    action="index.php?page=update-tag-valid&id=<?php echo $tag['id']; ?>">
    <input type="text"
      name="name"
      placeholder="Nom du tag"
      class="w-full border rounded-lg p-3"
      value="<?php echo htmlspecialchars($tag['name'] ?? ''); ?>">

    <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
      Publier
    </button>
  </form>
</main>
<?php include 'footer.php' ?>