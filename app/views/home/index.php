<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <header class="flex justify-center">
        <h1 class="text-2xl font-bold mb-6 text-center artikel-judul bg-gray-100 md:w-1/6 w-1/4">Artikel Terbaru</h1>
    </header>

    <!-- Daftar Artikel Terbaru -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach ($data['blogs'] as $blog) : ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="foto relative" style="background-image: url('<?= BASEURL ?>/img/blog/<?= $blog['foto_blogs'] ?>'); background-size: cover; background-position: center; width: 100%; height: 200px;">
                </div>
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-2"><?= htmlspecialchars($blog['judul'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <p class="text-gray-600 text-sm mb-4">Ditulis oleh <span class="font-semibold text-blue-700"><?= htmlspecialchars($blog['nama_a'], ENT_QUOTES, 'UTF-8') ?></span> | <span class="font-semibold"><?= date('d F Y', strtotime($blog['time_stamp'])) ?></span></p>
                    <p class="text-gray-700 line-clamp-3"><?= htmlspecialchars($blog['body'], ENT_QUOTES, 'UTF-8') ?></p>
                    <a href="<?= BASEURL ?>/blog/detail_blog?id=<?= $blog['id_blog'] ?>" class="text-blue-500 hover:underline mt-2 inline-block">Baca Selengkapnya</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Banner / Hero Section -->
    <div class="mt-12">
        <div class="bg-gray-800 text-white py-24 px-6 text-center rounded-lg shadow-xl">
            <h2 class="text-4xl font-bold mb-4"><?= $data['author'] ?></h2>
            <p class="text-lg mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis scelerisque tortor sit amet lorem viverra tincidunt.</p>
            <a href="/path/to/banner-link" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md inline-block">Tombol Banner</a>
        </div>
    </div>
</div>