<!-- Profile Untuk Semua yang sudah login -->

<div class="printable mx-auto max-w-7xl p-6 bg-white shadow-xl rounded-lg text-gray-900">
    <div class="rounded-t-lg h-32 sm:h-60 overflow-hidden">
        <img class="object-cover object-top w-full" src='https://images.unsplash.com/photo-1549880338-65ddcdfd017b?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt='Mountain'>
    </div>
    <div class="flex justify-center">
        <div class="relative">
            <?php if (isset($data['foto']) && !empty($data['foto'])) : ?>
                <div class="mx-auto w-32 h-32 flex justify-center bg-cover sm:w-40 sm:h-40 relative -mt-16 border-[6px] border-white rounded-full overflow-hidden">
                    <img class="object-cover object-center w-full" src="<?= BASEURL ?>/img/<?= $data['foto'] ?>" alt="Foto Profil">
                </div>
            <?php else : ?>
                <!-- Default image -->
                <div class="mx-auto w-32 h-32 flex justify-center bg-gray-300 sm:w-40 sm:h-40 relative -mt-16 border-[6px] border-white rounded-full overflow-hidden">
                    <img class="object-cover object-center w-full" alt="Foto Profil" src="<?= BASEURL ?>/img/anyms.jpg" alt="">
                </div>
            <?php endif; ?>
            <form id="uploadForm" action="<?= BASEURL ?>/anggota/uploadProfilePhoto" method="post" enctype="multipart/form-data">
                <label for="upload" class="absolute bottom-0 right-0 w-8 h-8 sm:w-8 sm:h-8 bg-blue-500 rounded-full flex items-center justify-center cursor-pointer">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <input type="file" id="upload" name="foto" class="hidden" accept="image/*" onchange="uploadImage()">
                    <input type="submit" value="Upload" style="display: none;">
                </label>
            </form>
        </div>
    </div>


    <div class="text-center mt-4">
        <h2 class="text-3xl font-bold"><?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
        <p class="text-lg text-gray-500"> <?php
                                            echo htmlspecialchars(!empty($_SESSION['status']) ? $_SESSION['status'] : 'Belum terdaftar');
                                            ?></p>
    </div>

    <div class="mt-8">
        <!-- Data Pribadi -->
        <section class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Data Pribadi</h3>
            <hr>
            <div class="grid grid-cols-2 gap-x-4">
                <p><span class="font-semibold">RT:</span> <?php echo htmlspecialchars($_SESSION['rt']); ?></p>
                <p><span class="font-semibold">Dusun:</span> <?php echo htmlspecialchars($_SESSION['dusun']); ?></p>
                <p><span class="font-semibold">Desa:</span> <?php echo htmlspecialchars($_SESSION['desa']); ?></p>
                <p><span class="font-semibold">Nomor HP:</span> <?php echo htmlspecialchars($_SESSION['no_hp']); ?></p>
                <p><span class="font-semibold">Email:</span> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            </div>
        </section>

        <!-- Kegiatan -->
        <section class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Kegiatan yang diikuti</h3>
            <hr>
            <ul>
                <?php if (!empty($data['kegiatan'])) : ?>
                    <?php foreach ($data['kegiatan'] as $activity) : ?>
                        <li><?php echo htmlspecialchars($activity['nama_kegiatan']); ?></li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="border px-4 py-2 text-center">No data available</td>
                    </tr>
                <?php endif; ?>
            </ul>
        </section>
    </div>
    <button class="bg-red-500 p-2 rounded-lg text-white btn-print px-4" onclick="window.print()">Print</button>

</div>