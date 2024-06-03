<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <table class="table-fixed border-collapse border border-gray-300 w-full shadow-md  bg-white">
        <thead class="bg-white">
            <tr>
                <th class="w-1/12 px-4 py-4 border border-gray-300 text-center">No</th>
                <th class="px-4 py-4 border border-gray-300 text-center">Nama Anggota</th>
                <th class="px-4 py-4 border border-gray-300 text-center">No Hp</th>
                <th class="px-4 py-4 border border-gray-300 text-center">Dusun</th>
                <th class="px-4 py-4 border border-gray-300 text-center">RT</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php if (!empty($data['members'])) : ?>
                <?php foreach ($data['members'] as $index => $anggota) : ?>
                    <tr class="hover:bg-gray-50">
                        <td class="w-1/12 border px-4 py-2 text-center"><?= $index + 1 ?></td>
                        <td class="border px-4 py-2 text-center"><?= htmlspecialchars($anggota['nama_a'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="border px-4 py-2 text-center"><?= htmlspecialchars($anggota['no_hp'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="border px-4 py-2 text-center"><?= htmlspecialchars($anggota['nama'], ENT_QUOTES, 'UTF-8') ?></td>
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