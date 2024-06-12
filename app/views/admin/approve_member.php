<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <a class="p-1 px-2 bg-blue-500 shadow-md text-white border hover:bg-blue-700" href="<?= BASEURL ?>/admin/">Back</a>

    <table id="example" class="display nowrap" style="width:100%">
        <thead class="bg-white">
            <tr>
                <th class="w-1/12 px-4 py-4 border border-gray-300">No</th>
                <th class="border border-gray-300">Nama Anggota</th>
                <th class="border border-gray-300">No Hp</th>
                <th class="border border-gray-300">Desa</th>
                <th class="border border-gray-300">Status Anggota</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['anggota'])) : ?>
                <?php foreach ($data['anggota'] as $index => $anggota) : ?>
                    <tr class="hover:bg-gray-50" data-id="<?= htmlspecialchars($anggota['id_member'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-nama="<?= htmlspecialchars($anggota['nama_a'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-no-hp="<?= htmlspecialchars($anggota['no_hp'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-desa="<?= htmlspecialchars($anggota['nama_desa'] ?? '', ENT_QUOTES, 'UTF-8') ?>" data-status="<?= htmlspecialchars($anggota['nama_keanggotaan'] ?? 'Belum Terdaftar', ENT_QUOTES, 'UTF-8') ?>">
                        <td class="w-1/12 border px-4 py-2 text-center"><?= $index + 1 ?></td>
                        <td class="border px-4 py-2 text-center"><?= htmlspecialchars($anggota['nama_a'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="border px-4 py-2 text-center"><?= htmlspecialchars($anggota['no_hp'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="border px-4 py-2 text-center"><?= htmlspecialchars($anggota['nama_desa'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="border px-4 py-2 text-center"><?= htmlspecialchars($anggota['nama_keanggotaan'] ?? 'Belum Terdaftar', ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="border px-4 py-2 text-center">No data available</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Klik Anggota yang ingin di Berikan status :</h2>
    <div id="member-details" class="hidden mt-8 border border-gray-300 rounded p-4 w-full">
        <h2 class="text-3xl font-bold mb-4">Member Details</h2>
        <div>
            <p class="font-bold">Nama:</p>
            <p><span id="member-nama"></span></p>
        </div>
        <div>
            <p class="font-bold">No Hp:</p>
            <p><span id="member-noHp"></span></p>
        </div>
        <div>
            <p class="font-bold">Desa:</p>
            <p><span id="member-desa"></span></p>
        </div>
        <div>
            <p class="font-bold">Status:</p>
            <p><span id="member-status"></span></p>
        </div>

        <form action="approve/approve_status" method="post">
            <input type="hidden" name="id" id="id-member">
            <label for="role" class="block mt-4 font-bold">Pilih Status Anggota:</label>
            <select name="status" id="status" class="mt-1 border p-2 border-black">
                <option value="ANS">ANSOR</option>
                <option value="BNS">BANSER</option>
                <option value="RJA">RIJALUL ANSOR</option>
                <!-- Add more roles as needed -->
            </select>
            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Berikan</button>
        </form>
    </div>


</div>