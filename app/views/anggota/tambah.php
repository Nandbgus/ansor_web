<!-- Isi konten halaman di sini -->
<h1 class="text-2xl font-bold">Halaman Tambah Anggota</h1>
<br>
<div id="contents" class="container mx-auto gap-4">
    <form action="<?= BASEURL ?>/admin/tambah_anggota" method="POST">
        <div id="content" class="rounded-sm w-full bg-white dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-gray-300 px-6 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white pr-6">
                    Tambah Anggota
                </h3>
            </div>
            <hr>
            <div class="py-4">
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Id Anggota
                    </label>
                    <input type="text" name="id" readonly required class="w-full mt-2 p-2 rounded-lg border border-gray-300 bg-white text-gray-700 outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-blue-500">
                </div>
                <div>
                    <label class="mb-3 block mt-2 text-sm font-medium text-black dark:text-white">
                        Nama Anggota
                    </label>
                    <input type="text" name="nama_a" required placeholder="ex : Ananda Bagus F" class="w-full mt-2 p-2 rounded-lg border border-gray-300 bg-white text-gray-700 outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-blue-500">
                </div>
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white mt-2">
                        Nomor HP
                    </label>
                    <input type="text" name="no_hp" placeholder="ex : 082228507585" required class="w-full mt-2 p-2 rounded-lg border border-gray-300 bg-white text-gray-700 outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-blue-500">
                </div>
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white mt-2">
                        Dusun
                    </label>
                    <select name="id_dusun" class="w-full p-2 rounded-lg border border-gray-300 mt-2 bg-white text-gray-700 outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-blue-500" placeholder="Tes">
                        <?php foreach ($data['dusun'] as $dusun) : ?>
                            <option value="<?= $dusun['id_dusun'] ?>" data-nama-desa="<?= $dusun['nama_desa'] ?>"><?= $dusun['nama_dusun'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="mb-3 block text-sm font-medium text-black mt-2 dark:text-white">
                        RT
                    </label>
                    <input type="text" name="rt" placeholder="ex: 37" class="w-full p-2 mt-2 rounded-lg border border-gray-300 bg-white text-gray-700 outline-none focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-blue-500">
                </div>
                <div>
                    <button type="submit" class="mt-4 w-full bg-gray-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah Anggota</button>
                </div>
            </div>
        </div>
    </form>
    <div id="lastIdAnggotaContainer" data-last-id="<?= $data['lastIdAnggota']["id"] ?? "XII265DEFAULT0" ?>"></div>

</div>