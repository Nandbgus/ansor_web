<div class="container mx-auto max-w-md p-6 bg-white shadow-xl rounded-lg text-gray-900">
    <form action="<?= BASEURL; ?>/auth/profileUpdate" method="post">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                Nama
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama" type="text" placeholder="Nama" value="<?= $_SESSION['user_name'] ?>">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nohp">
                No HP
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nohp" name="nohp" type="text" placeholder="No HP" value="<?= $_SESSION['no_hp'] ?>">
        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Simpan</button>
    </form>
</div>