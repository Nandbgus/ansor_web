    <div id="content" class="container  w-full">

        <table id="example" class="display nowrap " style="width:100%">
            <thead class="bg-white">
                <tr>
                    <th class="w-1/12 px-4 py-4 border border-gray-300 ">No</th>
                    <th class=" border border-gray-300 ">Nama Anggota</th>
                    <th class=" border border-gray-300 ">No Hp</th>
                    <th class=" border border-gray-300 ">Dusun</th>
                    <th class=" border border-gray-300 ">Desa</th>
                    <th class=" border border-gray-300 ">RT</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php if (!empty($data['members'])) : ?>
                    <?php foreach ($data['members'] as $index => $anggota) : ?>
                        <tr class="hover:bg-gray-50">
                            <td class="w-1/12 border px-4 py-2 text-center"><?= $index + 1 ?></td>
                            <td class="border px-4 py-2 text-center"><?= htmlspecialchars($anggota['nama_a'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="border px-4 py-2 text-center"><?= htmlspecialchars($anggota['no_hp'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="border px-4 py-2 text-center"><?= htmlspecialchars($anggota['nama_dusun'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="border px-4 py-2 text-center"><?= htmlspecialchars($anggota['nama_desa'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="border px-4 py-2 text-center"><?= htmlspecialchars($anggota['rt'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="border px-4 py-2 text-center">No data available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>