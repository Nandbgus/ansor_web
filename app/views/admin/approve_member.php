<div class="mx-auto max-w-7xl py-6">
    <div class="overflow-x-auto">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <div class="text-2xl mb-4">Pengajuan Kegiatan</div>
            <div class="min-w-full overflow-x-auto">
                <?php if (!empty($data['permohonan'])) : ?>
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama Pemohon</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Keterangan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Foto</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($data['permohonan'] as $permintaan) : ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($permintaan['nama_anggota'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($permintaan['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($permintaan['tanggal_kegiatan'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if (isset($permintaan['foto']) && !empty($permintaan['foto'])) : ?>
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-14 w-14">
                                                    <img class="h-14 w-14 object-cover rounded-full" src="<?= BASEURL ?>/img/sertifikat/<?= htmlspecialchars($permintaan['foto'], ENT_QUOTES, 'UTF-8'); ?>" alt="Foto Profil">
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <!-- Default image -->
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 object-cover rounded-full" alt="Foto Profil" src="<?= BASEURL ?>/img/sertifikat/anyms.jpg">
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex">
                                            <form action="<?= BASEURL ?>/approve/approve_status/<?php echo htmlspecialchars($permintaan['id_laporan'], ENT_QUOTES, 'UTF-8'); ?>/approve" method="post">
                                                <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-500 hover:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition duration-150 ease-in-out">
                                                    Setujui
                                                </button>
                                            </form>
                                            <form action="<?= BASEURL ?>/approve/approve_status/<?php echo htmlspecialchars($permintaan['id_laporan'], ENT_QUOTES, 'UTF-8'); ?>/rejected" method="post" class="ml-2">
                                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition duration-150 ease-in-out">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p class="text-center text-gray-500">Tidak ada data pengajuan kegiatan.</p>
                <?php endif; ?>
            </div>
            <br>
            <div class="text-2xl mb-4">Pengajuan Role</div>
            <div class="min-w-full overflow-x-auto">
                <?php if (!empty($data['req_role'])) : ?>
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama Pemohon</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Keterangan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal Permohonan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($data['req_role'] as $permintaan) : ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($permintaan['nama_a'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($permintaan['nama_keanggotaan'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($permintaan['time_create'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex">
                                            <form action="<?= BASEURL ?>/approve/approve_status_role/<?php echo htmlspecialchars($permintaan['id_role'], ENT_QUOTES, 'UTF-8'); ?>/approve" method="post">
                                                <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-500 hover:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition duration-150 ease-in-out">
                                                    Setujui
                                                </button>
                                            </form>
                                            <form action="<?= BASEURL ?>/approve/approve_status_role/<?php echo htmlspecialchars($permintaan['id_role'], ENT_QUOTES, 'UTF-8'); ?>/rejected" method="post" class="ml-2">
                                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition duration-150 ease-in-out">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p class="text-center text-gray-500">Tidak ada data pengajuan role.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>