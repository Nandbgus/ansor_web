<div class="printable mx-auto max-w-7xl p-6 bg-white shadow-sm rounded-lg text-gray-900 flex flex-col">
    <div class="top-section flex">
        <div class="head-content flex gap-2 w-full h-40 text-white">
            <div class="box rounded-md flex flex-col justify-between w-full h-auto shadow-sm bg-blue-500">
                <div class="main w-full p-2 flex justify-between">
                    <div class="left left-0 m-0 flex flex-col">
                        <span class="text-5xl font-bold"><?= $data['sertif']['totalKegiatan'] ?></span>
                        <span>Sertifikat</span>
                    </div>
                    <div class="right right-0 w-20 h-auto pt-4">
                        <img class="w-auto" src="<?= BASEURL ?>/img/asset/certificated.png" alt="">
                    </div>
                </div>
                <div class="bottom rounded-b-md bg-blue-700  w-full text-center"><a href="<?= BASEURL ?>/anggota/sertifikat">Lihat Sertifikat</a></div>
            </div>
            <div class="box flex rounded-md flex-col justify-between w-full h-auto shadow-sm bg-green-500">
                <div class="main w-full p-2 flex justify-between">
                    <div class="left left-0 m-0 flex flex-col">
                        <span class="text-3xl font-bold"><?= $data['diri']['nama_keanggotaan'] ?? 'Belum Terdaftar' ?></span>
                        <span>Role</span>
                    </div>
                    <div class="right right-0 m-0 w-20 h-auto pt-4">
                        <img class="w-auto" src="<?= BASEURL ?>/img/asset/role.png" alt="">
                    </div>
                </div>
                <div class="bottom rounded-b-md bg-green-700 text-white w-full text-center">Check Info</div>
            </div>
            <div class="box rounded-md flex flex-col justify-between w-full h-auto shadow-sm bg-yellow-500">
                <div class="main w-full p-2 flex justify-between">
                    <div class="left left-0 m-0 flex flex-col">
                        <span class="text-5xl font-bold">150</span>
                        <span>Laporan Kegiatan</span>
                    </div>
                    <div class="right w-20 h-auto pt-4">
                        <img class="w-auto" src="<?= BASEURL ?>/img/asset/activity.png" alt="">
                    </div>
                </div>
                <div class="bottom rounded-b-md bg-yellow-700 text-white w-full text-center">Check Info</div>
            </div>
        </div>
    </div>

    <div class="content-graph">
        <?php foreach ($data['status'] as $role) : ?>
            <div class="mb-4 p-4 border rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold">Role: <?= $role['role']; ?></h3>
                <p>Status: <?= $role['status_verif']; ?></p>
                <form action="<?= BASEURL; ?>/approve/updatePermintaanRole" method="POST" class="mt-4">
                    <input type="hidden" name="id_role" value="<?= $role['id_role']; ?>">
                    <label for="role" class="block mb-2">Update Status:</label>
                    <select name="role" id="status" class="block w-full p-2 border rounded">
                        <option value="ANS" <?= $role['role'] == 'ANS' ? 'selected' : ''; ?>>ANSOR</option>
                        <option value="BNS" <?= $role['role'] == 'BNS' ? 'selected' : ''; ?>>BANSER</option>
                        <option value="RJA" <?= $role['role'] == 'RJA' ? 'selected' : ''; ?>>RIJALUL ANSOR</option>
                    </select>
                    <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Update Status</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>