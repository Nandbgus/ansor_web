<!-- Profile Untuk Semua yang sudah login -->
<br>
<div id="elementToPrint" class=" printable mx-auto max-w-7xl p-6 bg-white shadow-xl rounded-lg text-gray-900">
    <div class="rounded-t-lg h-32 sm:h-60 overflow-hidden">
        <img class="object-cover object-top w-full" src='https://images.unsplash.com/photo-1549880338-65ddcdfd017b?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt='Mountain'>
    </div>
    <div class="flex justify-center">
        <div class="relative">
            <?php if (isset($data['foto']) && !empty($data['foto'])) : ?>
                <div class="mx-auto w-32 h-32 flex justify-center bg-cover sm:w-40 sm:h-40 relative -mt-16 border-[6px] border-white rounded-full overflow-hidden">
                    <img class="object-cover object-center w-full" src="<?= BASEURL ?>/img/profile/<?= $data['foto'] ?>" alt="Foto Profil">
                </div>
            <?php else : ?>
                <!-- Default image -->
                <div class="mx-auto w-32 h-32 flex justify-center bg-gray-300 sm:w-40 sm:h-40 relative -mt-16 border-[6px] border-white rounded-full overflow-hidden">
                    <img class="object-cover object-center w-full" alt="Foto Profil" src="<?= BASEURL ?>/img/profile/anyms.jpg" alt="">
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
            </div>
        </section>

        <!-- Kegiatan -->
        <div class="kegiatan w-full bg-white shadow-md rounded-lg overflow-hidden my-10">
            <div class="p-4 bg-gray-200">
                <h2 class="text-2xl font-semibold">Pengalaman Kegiatan</h2>
            </div>
            <div class="divide-y divide-gray-200 ">
                <?php foreach ($data['kg']['kegiatanList'] as $activity) : ?>
                    <div class="p-4 flex">
                        <?php if (isset($activity['foto']) && !empty($activity['foto'])) : ?>
                            <div class="w-20 h-20 flex-shrink-0 mr-4">
                                <img class="object-cover object-center w-full h-full rounded-lg" src="<?= BASEURL ?>/img/sertifikat/<?= $activity['foto'] ?>" alt="Foto Sertifikat">
                            </div>
                        <?php else : ?>
                            <!-- Default image -->
                            <div class="w-20 h-20 flex-shrink-0 mr-4 bg-gray-300 rounded-lg">
                                <img class="object-cover object-center w-full h-full rounded-lg" src="<?= BASEURL ?>/img/sertifikat/anyms.jpg" alt="Foto Sertifikat">
                            </div>
                        <?php endif; ?>
                        <div class="flex-1">
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
            </div>
        </div>

    </div>

    <button class="bg-red-500 no-print p-2 rounded-lg text-white btn-print px-4" onclick="print()">Print</button>

</div>