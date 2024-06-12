 <article class="prose lg:prose-xl mx-auto">
     <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($data['blog']['judul'], ENT_QUOTES, 'UTF-8') ?></h1>
     <p class="text-gray-600 text-sm mb-4">Ditulis oleh <span class="font-semibold text-blue-700"><?= htmlspecialchars($data['blog']['nama_a'], ENT_QUOTES, 'UTF-8') ?></span> | <span class="font-semibold"><?= date('d-m-Y', strtotime($data['blog']['time_stamp'])) ?></span></p>
     <div class="mb-4">
         <?php foreach ($data['blog']['kategories'] as $category) : ?>
             <span class="mr-2 mb-2 px-2 py-1 border border-solid rounded text-sm"># <?= htmlspecialchars($category['nama_kategori'], ENT_QUOTES, 'UTF-8') ?></span>
         <?php endforeach; ?>
     </div>
     <div class="text-gray-700 leading-relaxed">
         <?= nl2br(htmlspecialchars($data['blog']['body'], ENT_QUOTES, 'UTF-8')) ?>
     </div>
 </article>