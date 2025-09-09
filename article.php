<?php include 'header.php' ?>
<main class="max-w-6xl mx-auto px-4 py-10 grow">
  <article class="mb-12 min-w-[700px]">
    <h1 class="text-4xl font-bold mb-4">Titre de l’article</h1>
    <p class="text-gray-500 mb-6">Par Admin • 12/08/2025</p>
    <img src="assets/img/article1.jpg" alt="" class="rounded-lg mb-6">
    <p class="leading-relaxed mb-6">Contenu complet de l’article... Lorem ipsum dolor sit amet...</p>
    <div class="flex gap-2">
      <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full text-sm">#Tag1</span>
      <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full text-sm">#Tag2</span>
    </div>
  </article>
  <section>
    <h2 class="text-2xl font-semibold mb-4">Commentaires</h2>
    <div class="space-y-4 mb-6">
      <div class="bg-white p-4 rounded-lg shadow">
        <p class="text-gray-700">Super article !</p>
        <p class="text-sm text-gray-500 mt-2">Posté par Jean, 12/08/2025</p>
      </div>
    </div>
    <form class="bg-white p-6 rounded-lg shadow space-y-4">
      <textarea placeholder="Votre commentaire..." class="w-full border rounded-lg p-3"></textarea>
      <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Envoyer</button>
    </form>
  </section>
</main>
<?php include 'footer.php' ?>