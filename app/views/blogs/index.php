<div id="blogApp" data-current-page="<?= $data['currentPage'] ?>" data-total-pages="<?= $data['totalPages'] ?>">
    <!-- Bagian Pencarian dan Filter -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-2">
        <div class="mb-4 md:mb-0 w-full">
            <input id="searchInput" type="text" placeholder="Cari..." class="w-full bg-white px-4 py-2 shadow-sm rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="flex items-center space-x-2 gap-2">
            <select id="categoryFilter" class="px-4 py-2 shadow-sm rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="">Semua Kategori</option>
                <?php foreach ($data['kategories'] as $category) : ?>
                    <option class="" value="<?= htmlspecialchars($category['kategori'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($category['kategori'], ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <!-- Grid Konten -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4" id="contentGrid">
        <!-- PHP Loop to display blogs -->
        <?php foreach ($data['isi'] as $blog) : ?>
            <div class="konten p-6 rounded-md shadow-sm tracking-normal bg-white blog-item" data-title="<?= htmlspecialchars($blog['judul'], ENT_QUOTES, 'UTF-8') ?>" data-categories="<?= htmlspecialchars(json_encode(array_column($blog['kategories'], 'id_kategori')), ENT_QUOTES, 'UTF-8') ?>">
                <a href="<?= BASEURL ?>/blog/detail_blog?id=<?= $blog['id_blog'] ?>">
                    <h2 class="text-xl md:text-2xl font-bold mb-4"><?= htmlspecialchars($blog['judul'], ENT_QUOTES, 'UTF-8') ?></h2>
                </a>
                <p class="text-gray-600 text-sm mb-4">Ditulis oleh <span class="font-semibold text-blue-700"><?= htmlspecialchars($blog['nama_a'], ENT_QUOTES, 'UTF-8') ?></span> | <span class="font-semibold"><?= htmlspecialchars($blog['time_stamp'], ENT_QUOTES, 'UTF-8') ?></span></p>
                <div class="foto relative" style="background-image: url('<?= BASEURL ?>/img/blog/<?= $blog['foto_blogs'] ?>'); background-size: cover; background-position: center; width: 100%; height: 400px;">
                    <div class="absolute bottom-0 mb-4">
                        <?php foreach ($blog['kategories'] as $category) : ?>
                            <span class="mr-2 mb-2 px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm"># <?= htmlspecialchars($category['nama_kategori'], ENT_QUOTES, 'UTF-8') ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <p class="text-gray-700 truncate line-clamp-2"><?= htmlspecialchars($blog['body'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Pagination -->
    <div class="pagination flex items-center justify-center mt-8 gap-2">
        <?php if ($data['totalPages'] > 1) : ?>
            <?php if ($data['currentPage'] > 1) : ?>
                <a href="#" class="pagination-prev px-3 py-1 bg-gray-200 border border-gray-300 text-gray-700 rounded-md mr-2" data-page="<?= $data['currentPage'] - 1 ?>">Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $data['totalPages']; $i++) : ?>
                <?php if ($i == $data['currentPage']) : ?>
                    <span class="pagination-page px-3 py-1 bg-blue-500 text-white border border-blue-500 rounded-md mr-2"><?= $i ?></span>
                <?php else : ?>
                    <a href="#" class="pagination-page px-3 py-1 bg-gray-200 border border-gray-300 text-gray-700 rounded-md mr-2" data-page="<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($data['currentPage'] < $data['totalPages']) : ?>
                <a href="#" class="pagination-next px-3 py-1 bg-gray-200 border border-gray-300 text-gray-700 rounded-md ml-2" data-page="<?= $data['currentPage'] + 1 ?>">Next</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>