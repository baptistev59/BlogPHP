<?php include 'header.php' ?>
<main class="max-w-6xl mx-auto px-4 py-10 grow">
  <h1 class="text-3xl font-bold mb-6 min-w-[700px]">Gestion des tags</h1>
  <form class="mb-6 flex gap-4" action="index.php?page=create-tag" method="post">
    <input type="text" name="name" placeholder="Nouveau tag" class="border rounded-lg p-3 flex-1">
    <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Ajouter</button>
  </form>
  <table class="w-full bg-white shadow rounded-lg">
    <thead class="bg-gray-100 text-left">
      <tr>
        <th class="p-4">Tag</th>
        <th class="p-4">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($tags as $tag) { ?>
        <tr class="border-t">
          <td class="p-4">#<?php echo $tag->getName(); ?></td>
          <td class="p-4 space-x-2">
            <a href="index.php?page=update-tag&id=<?php echo $tag->getId(); ?>" class="text-indigo-600 hover:underline">Modifier</a>
            <a href="index.php?page=delete-tag&id=<?php echo $tag->getId(); ?>" class="text-red-600 hover:underline">Supprimer</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</main>
<?php include 'footer.php' ?>