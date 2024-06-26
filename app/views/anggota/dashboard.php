<div class="printable mx-auto max-w-7xl p-6 bg-white shadow-sm rounded-lg text-gray-900 flex flex-col">
    <?php foreach ($data['status'] as $role) : ?>
        <div class="top-section flex flex-col md:flex-row gap-4">
            <div class="head-content flex flex-col md:flex-row gap-4 w-full text-white">
                <div class="box rounded-md flex flex-col justify-between w-full h-auto shadow-sm bg-blue-500">
                    <div class="main w-full p-2 flex justify-between">
                        <div class="left left-0 m-0 flex flex-col">
                            <span class="text-5xl font-bold"><?= $data['sertif']['totalKegiatanApproved'] ?> / <?= $data['sertif']['totalKegiatan'] ?></span>
                            <span>Sertifikat</span>
                        </div>
                        <div class="right right-0 w-20 h-auto pt-4">
                            <img class="w-auto" src="<?= BASEURL ?>/img/asset/certificated.png" alt="">
                        </div>
                    </div>
                    <div class="bottom rounded-b-md bg-blue-700 w-full text-center">
                        <a href="<?= BASEURL ?>/anggota/profile">Lihat Sertifikat</a>
                    </div>
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
                    <div class="bottom rounded-b-md bg-green-700 text-white w-full text-center">
                        <a href="#" class="check-info" data-role-id="<?= $role['id_role']; ?>" data-role-name="<?= $role['role']; ?>">Check Info</a>
                    </div>
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
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal Structure -->
<div id="roleModal" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="modal-content bg-white p-6 rounded-lg shadow-lg md:w-1/2">
        <span class="close-modal absolute top-2 right-2 text-gray-500 cursor-pointer">&times;</span>
        <h3 class="text-xl font-semibold mb-4">Update Role Status</h3>
        <form id="roleForm" action="<?= BASEURL; ?>/approve/updatePermintaanRole" method="POST">
            <input type="hidden" name="id_role" id="modalRoleId">
            <label for="role" class="block mb-2">Update Status:</label>
            <select name="role" id="modalStatus" class="block w-full p-2 border rounded">
                <option value="ANS">ANSOR</option>
                <option value="BNS">BANSER</option>
                <option value="RJA">RIJALUL ANSOR</option>
            </select>
            <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Update Status</button>
        </form>
    </div>
</div>