<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 ">
    <div class="grid grid-cols-3 gap-4">
        <?php foreach ($data['isi'] as $isi) : ?>
            <div class=" p-6 rounded-lg shadow-md border tracking-normal bg-white">
                <h2 class="text-3xl font-bold mb-4">
                    <?= $isi["judul"] ?>
                </h2>
                <p class="text-gray-600 text-sm mb-4">Ditulis oleh <span class="font-semibold text-blue-700"><?= $isi["nama_a"] ?></span> | <span class="font-semibold"><?= $isi["time_stamp"] ?></span></p>
                <?php foreach ($isi['kategories'] as $category) : ?>
                    <span class="mb-2 px-2 py-1 bg-blue-500 text-white rounded text-sm"><?= htmlspecialchars($category['nama_kategori'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php endforeach; ?>
                <p class="text-gray-700 truncate line-clamp-2"><?= $isi["body"] ?>
            </div>
        <?php endforeach ?>
    </div>
</div>