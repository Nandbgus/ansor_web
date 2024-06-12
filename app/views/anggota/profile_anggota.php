<!-- Profile Member Via Admin -->

<div class="max-w-4xl mx-auto py-10 px-6 sm:px-8 lg:px-10 bg-white shadow-md rounded-lg">
    <a class="p-1 px-2 bg-blue-500 shadow-md text-white border hover:bg-blue-700" href="<?= BASEURL ?>/admin/daftar_anggota">Back</a>

    <div class="text-center border-b pb-6">
        <h1 class="text-4xl font-bold text-gray-800"><?= $data['head'] ?></h1>
    </div>
    <?php $member = $data['member']; ?>
    <div class="mt-8 space-y-4">
        <div class="biodata pt-8">
            <div class="flex justify-center">
                <div class="relative">
                    <?php if (isset($member['foto']) && !empty($member['foto'])) : ?>
                        <div class="mx-auto w-32 h-32 flex justify-center bg-cover sm:w-40 sm:h-40 relative -mt-16 border-[6px] border-white rounded-full overflow-hidden">
                            <img class="object-cover object-center w-full" src="<?= BASEURL ?>/img/<?= $member['foto'] ?>" alt="Foto Profil">
                        </div>
                    <?php else : ?>
                        <!-- Default image -->
                        <div class="mx-auto w-32 h-32 flex justify-center bg-gray-300 sm:w-40 sm:h-40 relative -mt-16 border-[6px] border-white rounded-full overflow-hidden">
                            <img class="object-cover object-center w-full" alt="Foto Profil" src="<?= BASEURL ?>/img/anyms.jpg" alt="">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <h2 class="text-2xl font-semibold text-gray-800">Data Diri</h2>
            <div class="flex items-center">
                <span class="w-48 font-bold  text-gray-700">Nama</span>
                <span class="text-gray-900">: <?= htmlspecialchars($member['nama_a'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <div class="flex items-center">
                <span class="w-48 font-bold text-gray-700">No HP</span>
                <span class="text-gray-900">: <?= htmlspecialchars($member['no_hp'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <div class="flex items-center">
                <span class="w-48 font-bold text-gray-700">Dusun</span>
                <span class="text-gray-900">: <?= htmlspecialchars($member['nama_dusun'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <div class="flex items-center">
                <span class="w-48 font-bold text-gray-700">Desa</span>
                <span class="text-gray-900">: <?= htmlspecialchars($member['nama_desa'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <div class="flex items-center">
                <span class="w-48 font-bold text-gray-700">RT</span>
                <span class="text-gray-900">: <?= htmlspecialchars($member['rt'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <div class="flex items-center">
                <span class="w-48 font-bold text-gray-700">Status Keanggotaan</span>
                <span class="text-gray-900">: <?= htmlspecialchars($member['nama_keanggotaan'] ?? 'Belum Terdaftar', ENT_QUOTES, 'UTF-8') ?></span>
            </div>
        </div>


        <!-- Activities Section -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-800">Kegiatan yang Diikuti</h2>
            <ul class="mt-2 list-disc list-inside text-gray-700">
                <?php if (!empty($data['kegiatan'])) : ?>
                    <?php foreach ($data['kegiatan'] as $activity) : ?>
                        <li><?= htmlspecialchars($activity['nama_kegiatan'], ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="border px-4 py-2 text-center">No data available</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>