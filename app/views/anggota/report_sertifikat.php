<h1 class="text-2xl font-bold">Halaman Sertifikat</h1>
<br>
<div id="contents" class="container mx-auto gap-4 flex flex-col md:flex-row" x-data="{ isMinimizedForm: false, isMinimizedBlogs: false }">
    <div :class="isMinimizedForm ? 'w-full sm:w-1/12 mb-4 md:mb-0' : (isMinimizedBlogs ? 'w-full sm:w-full' : 'sm:w-8/12 w-full')" class="rounded-sm bg-white border border-solid border-gray-300 shadow-sm overflow-hidden transition-all duration-300">
        <div class="flex justify-between items-center p-4">
            <h2 class="text-lg font-bold" x-show="!isMinimizedForm">Form Pengajuan Permohonan</h2>
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
            <form action="<?= BASEURL ?>/approve/kirimPermintaan" method="POST" enctype="multipart/form-data">
                <label for="foto" class="block text-gray-700 text-sm font-bold mb-2">foto</label>
                <input id="foto" type="file" name="foto" type="text" class="border border-solid border-gray-300 px-2 py-1 rounded-md w-full mb-4" required>

                <label for="tanggal" class="block text-gray-700 text-sm font-bold mb-2">tanggal</label>
                <input type="date" id="tanggal" name="tanggal_kegiatan" class="border border-solid border-gray-300 px-2 py-1 rounded-md w-full mb-4" rows="5" required></input>

                <label for="kegiatan" class="block text-gray-700 text-sm font-bold mb-2">Kegiatan</label>
                <select id="kegiatan" name="id_kegiatan" class="border border-solid border-gray-300 px-2 py-1 rounded-md w-full mb-4" required>
                    <?php foreach ($data['kegiatan'] as $category) : ?>
                        <option value="<?= $category['id_kegiatan'] ?>"><?= htmlspecialchars($category['nama'], ENT_QUOTES, 'UTF-8') ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Kirim Permohonan</button>
            </form>
        </div>
    </div>
    <div :class="isMinimizedBlogs ? 'sm:w-1/12 w-full' : 'sm:w-full w-full'" class="rounded-sm bg-white border border-solid border-gray-300 shadow-sm overflow-hidden transition-all duration-300">

        <div class="flex justify-between items-center p-4">
            <span x-show="!isMinimizedBlogs">Total Kegiatan : <?= $data['totalKegiatan'] ?></span>
            <button @click="isMinimizedBlogs = !isMinimizedBlogs" class="focus:outline-none">
                <svg x-show="isMinimizedBlogs" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                </svg>

                <svg x-show="!isMinimizedBlogs" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25" />
                </svg>
            </button>
        </div>

        <div x-show="!isMinimizedBlogs" class="p-4">
            <div id="blogList" class="mt-2 tampil-blogs w-full gap-4 overflow-y-scroll h-80">
                <?php if (!empty($data['kegiatanList'])) : ?>
                    <?php foreach ($data['kegiatanList'] as $activity) : ?>
                        <div class="flex items-center border-b border-gray-200 py-4">
                            <?php if (isset($activity['foto']) && !empty($activity['foto'])) : ?>
                                <div class="w-32 h-32 sm:w-40 sm:h-40 flex-shrink-0 mr-4">
                                    <img class="object-cover object-center w-full h-full rounded-lg" src="<?= BASEURL ?>/img/sertifikat/<?= $activity['foto'] ?>" alt="Foto Sertifikat">
                                </div>
                            <?php else : ?>
                                <!-- Default image -->
                                <div class="w-32 h-32 sm:w-40 sm:h-40 flex-shrink-0 mr-4 bg-gray-300 rounded-lg">
                                    <img class="object-cover object-center w-full h-full rounded-lg" src="<?= BASEURL ?>/img/sertifikat/anyms.jpg" alt="Foto Sertifikat">
                                </div>
                            <?php endif; ?>
                            <div>
                                <p class="font-semibold"><?= $activity['nama_kegiatan'] ?></p>
                                <p class="text-sm text-gray-500">Dilaksanakan pada: <span class="text-blue-500"><?= $activity['tanggal_kegiatan'] ?></span></p>
                                <p class="text-sm">Status:
                                    <?php if ($activity['status_verif'] == 'approve') : ?>
                                        <span class="text-green-500"><?= ucfirst($activity['status_verif']) ?></span>
                                    <?php elseif ($activity['status_verif'] == 'rejected') : ?>
                                        <span class="text-red-500"><?= ucfirst($activity['status_verif']) ?></span>
                                    <?php else : ?>
                                        <span class="text-gray-500"><?= ucfirst($activity['status_verif']) ?></span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php else : ?>
                    <tr>
                        <td colspan="5" class="border px-4 py-2 text-center">No data available</td>
                    </tr>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>