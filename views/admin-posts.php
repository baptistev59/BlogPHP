<?php include 'header.php' ?>
<main class="max-w-6xl mx-auto px-4 py-10 grow">
  <h1 class="text-3xl font-bold mb-6  min-w-[700px]">Gestion des articles</h1>
  <a href="index.php?page=create-post" class="mb-6 inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Nouvel article</a>
  <table class="w-full bg-white shadow rounded-lg">
    <thead class="bg-gray-100 text-left">
      <tr>
        <th class="p-4">Titre</th>
        <th class="p-4">Auteur</th>
        <th class="p-4">Date</th>
        <th class="p-4">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($articles as $article) { ?>
        <tr class="border-t">
          <td class="p-4"><?php echo $article->getTitle(); ?></td>
          <td class="p-4"><?php echo $article->getNameUser(); ?></td>
          <td class="p-4"><?php echo date('d/m/Y', strtotime($article->getDate())); ?></td>
          <td class="p-4 space-x-2">
            <a href="index.php?page=update-post&id=<?php echo $article->getId(); ?>" class="text-indigo-600 hover:underline">Modifier</a>
            <a href="index.php?page=delete-post&id=<?php echo $article->getId(); ?>" class="text-red-600 hover:underline">Supprimer</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</main>
<?php include 'footer.php' ?>