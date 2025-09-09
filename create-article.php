<?php include 'header.php' ?>
<main class="max-w-6xl mx-auto px-4 py-10 grow">
  <h1 class="text-3xl font-bold mb-6">Créer un nouvel article</h1>
  <form class="bg-white p-6 rounded-lg shadow space-y-4">
    <input type="text" placeholder="Titre de l’article" class="w-full border rounded-lg p-3">
    <textarea placeholder="Contenu de l’article" class="w-full border rounded-lg p-3 h-40"></textarea>
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