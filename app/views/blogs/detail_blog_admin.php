<article class="prose lg:prose-xl mx-auto w-full p-8">
    <nav class="flex pb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="<?= BASEURL ?>/admin" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Admin
                </a>
            </li>
            <li class="inline-flex items-center">
                <a href="<?= BASEURL ?>/admin/form_blogs" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    Tambah Blogs
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"><?= $data['head'] ?></span>
                </div>
            </li>
        </ol>
    </nav>
    <hr>
    <!-- Breadcrumb -->
    <form action="<?= BASEURL ?>/blog/update_blog" method="POST" enctype="multipart/form-data" class="mb-4 py-2 space-y-4">
        <input type="hidden" name="id_blog" value="<?= $data['blog']['id_blog'] ?>">

        <div>
            <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
            <input id="judul" name="judul" type="text" class="border border-gray-300 px-4 py-2 rounded-md w-full" value="<?= htmlspecialchars($data['blog']['judul'], ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div>
            <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body</label>
            <textarea id="body" name="body" class="border border-gray-300 px-4 py-2 rounded-md w-full" rows="5" required><?= htmlspecialchars($data['blog']['body'], ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>

        <div>
            <label for="foto" class="block text-gray-700 text-sm font-bold mb-2">Foto</label>
            <input type="file" id="foto" name="foto" class="border border-gray-300 px-4 py-2 rounded-md w-full" accept="image/*">
            <img id="currentFoto" class="object-cover object-center w-24 h-24 mt-2 cursor-pointer" src="<?= BASEURL ?>/img/blog/<?= $data['blog']['foto_blogs'] ?>" alt="">
        </div>

        <div>
            <label for="kategori" class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
            <div class="flex gap-2">
                <select id="kategori" class="border border-gray-300 px-4 rounded-md w-full">
                    <?php foreach ($data['kategories'] as $category) : ?>
                        <option value="<?= $category['id_kategori'] ?>">
                            <?= htmlspecialchars($category['kategori'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600" onclick="addCategory()">Add</button>
            </div>
        </div>

        <div id="selectedCategories" class="space-y-2">
            <?php foreach ($data['blog']['kategories'] as $category) : ?>
                <div class="selected-category bg-gray-200 rounded-md px-2 py-1 inline-flex items-center space-x-2" data-id="<?= $category['id_kategori'] ?>">
                    <span><?= htmlspecialchars($category['nama_kategori'], ENT_QUOTES, 'UTF-8') ?></span>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeCategory(this)">X</button>
                    <input type="hidden" name="kategori[]" value="<?= $category['id_kategori'] ?>">
                </div>
            <?php endforeach; ?>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Blog</button>
        </div>
    </form>

    <!-- Form Delete -->
    <form action="<?= BASEURL ?>/blog/hapus_blog" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus blog ini?');" class="mt-4">
        <input type="hidden" name="id_blog" value="<?= $data['blog']['id_blog'] ?>">
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete Blog</button>
    </form>

    <!-- Modal Preview Gambar -->
    <div id="modalPreview" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden p-60">
        <div class="relative bg-white md:p-8 py-64 rounded-md flex justify-center">
            <button id="closeModal" class="absolute top-0 right-0 bg-red-500 text-white px-2 py-1 rounded-full">Close</button>
            <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-full">
        </div>
    </div>

</article>