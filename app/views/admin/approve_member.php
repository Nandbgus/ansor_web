<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

    <table border="1" class="w-full">
        <tr>
            <th>Nama Pemohon</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($data['permohonan'] as $permintaan) : ?>
            <tr>
                <td><?php echo $permintaan['nama_anggota'] ?></td>
                <td><?php echo $permintaan['nama'] ?></td>
                <td><?php echo $permintaan['tanggal_kegiatan'] ?></td>
                <td><?php if (isset($permintaan['foto']) && !empty($permintaan['foto'])) : ?>
                        <div class="mx-auto w-32 h-32 flex justify-center bg-cover sm:w-40 sm:h-40 relative overflow-hidden">
                            <img class="object-cover object-center w-full" src="<?= BASEURL ?>/img/sertifikat/<?= $permintaan['foto'] ?>" alt="Foto Profil">
                        </div>
                    <?php else : ?>
                        <!-- Default image -->
                        <div class="mx-auto w-32 h-32 flex justify-center bg-gray-300 sm:w-40 sm:h-40 relative overflow-hidden">
                            <img class="object-cover object-center w-full" alt="Foto Profil" src="<?= BASEURL ?>/img/sertifikat/anyms.jpg" alt="">
                        </div>
                    <?php endif; ?>
                </td>
                <td>
                    <form action="<?= BASEURL ?>/approve/approve_status/<?php echo htmlspecialchars($permintaan['id_laporan']); ?>/approve" method="post">
                        <button type="submit" class="bg-green-500 w-full hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Setujui
                        </button>
                    </form>

                    <form action="<?= BASEURL ?>/approve/approve_status/<?php echo htmlspecialchars($permintaan['id_laporan']); ?>/rejected" method="post">
                        <button type="submit" class="bg-red-500 w-full hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Tolak
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>