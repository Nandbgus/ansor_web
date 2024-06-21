<h1 class="text-2xl font-bold">Halaman Blogs</h1>
<br>
<div id="contents" class="container mx-auto gap-4 flex flex-col md:flex-row" x-data="{ isMinimizedForm: false, isMinimizedBlogs: false }">
     <div :class="isMinimizedForm ? 'w-full sm:w-1/12 mb-4 md:mb-0' : (isMinimizedBlogs ? 'w-full sm:w-full' : 'sm:w-8/12 w-full')" class="rounded-md bg-white  shadow-sm overflow-hidden transition-all duration-300">
          <div class="flex justify-between items-center p-4">
               <h2 class="text-lg font-bold" x-show="!isMinimizedForm">Form Tambah Blog</h2>
               <button @click="isMinimizedForm = !isMinimizedForm" class=" focus:outline-none">
                    <svg x-show="!isMinimizedForm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25" />
                    </svg>
                    <svg x-show="isMinimizedForm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">

                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                    </svg>
               </button>

          </div>
          <div x-show="!isMinimizedForm" class="p-4">
               <form action="<?= BASEURL ?>/blog/tambah_blog" method="POST" enctype="multipart/form-data">
                    <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
                    <input id="judul" name="judul" type="text" class="border border-solid border-gray-300 px-2 py-1 rounded-md w-full mb-4" required>

                    <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body</label>
                    <textarea id="body" name="body" class="border border-solid border-gray-300 px-2 py-1 rounded-md w-full mb-4" rows="5" required></textarea>

                    <label for="foto" class="block text-gray-700 text-sm font-bold mb-2">Foto</label>
                    <input type="file" id="foto" name="foto" class="border border-solid border-gray-300 px-2 py-1 rounded-md w-full mb-4" rows="5" accept="image/*" required></input>

                    <label for="kategori" class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                    <select id="kategori" name="kategori" class="border border-solid border-gray-300 px-2 py-1 rounded-md w-full mb-4" required>
                         <?php foreach ($data['kategories'] as $category) : ?>
                              <option value="<?= $category['id_kategori'] ?>"><?= htmlspecialchars($category['kategori'], ENT_QUOTES, 'UTF-8') ?></option>
                         <?php endforeach; ?>
                    </select>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Kirim Postingan</button>
               </form>
          </div>
     </div>


     <div :class="isMinimizedBlogs ? 'sm:w-1/12 w-full' : 'sm:w-full w-full'" class="rounded-md bg-white  shadow-sm overflow-hidden transition-all duration-300">

          <div class="flex justify-between items-center p-4">
               <span x-show="!isMinimizedBlogs">Total Post : <?= $data['total'] ?></span>
               <button @click="isMinimizedBlogs = !isMinimizedBlogs" class="focus:outline-none">
                    <svg x-show="isMinimizedBlogs" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                    </svg>

                    <svg x-show="!isMinimizedBlogs" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25" />
                    </svg>
               </button>
          </div>

          <div x-show="!isMinimizedBlogs" class="p-4 ">
               <input type="text" id="searchInput" placeholder="Ex : One Piece..." class="w-full border border-solid rounded-md px-4 py-2 bg-gray-100">
               <div id="blogList" class="mt-2 tampil-blogs grid grid-cols-1 md:grid-cols-2 gap-4 overflow-y-scroll h-80">
                    <?php foreach ($data['blogs'] as $isi) : ?>
                         <div class="p-6 rounded-lg shadow-md border tracking-normal">
                              <a class="hover:text-blue-300" href="<?= BASEURL ?>/blog/detail_blog_admin?id=<?= $isi['id_blog'] ?>">
                                   <h2 class="text-3xl font-bold mb-4"><?= htmlspecialchars($isi["judul"], ENT_QUOTES, 'UTF-8') ?></h2>
                              </a>
                              <img class="w-24 mb-2" src="<?= BASEURL ?>/img/blog/<?= $isi['foto_blogs'] ?>" alt="">
                              <?php foreach ($isi['kategories'] as $category) : ?>
                                   <span class="mr-2 mb-2 px-2 py-1 bg-gray-200 rounded text-sm"><?= htmlspecialchars($category['nama_kategori'], ENT_QUOTES, 'UTF-8') ?></span>
                              <?php endforeach; ?>
                              <p class="text-gray-600 text-sm mb-4 mt-4">Ditulis oleh <span class="font-semibold text-blue-700"><?= htmlspecialchars($isi["nama_a"], ENT_QUOTES, 'UTF-8') ?></span> | <span class="font-semibold"><?= date('d-m-Y', strtotime($isi['time_stamp'])) ?></span></p>
                              <p class="text-gray-700 truncate line-clamp-2"><?= htmlspecialchars($isi["body"], ENT_QUOTES, 'UTF-8') ?></p>
                         </div>
                    <?php endforeach ?>
               </div>
          </div>
     </div>
</div>