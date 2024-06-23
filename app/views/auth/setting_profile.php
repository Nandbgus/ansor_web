<br>
<div class="container mx-auto w-full p-6 bg-white shadow-md rounded-lg text-gray-900">
    <form action="<?= BASEURL; ?>/auth/profileUpdate" method="post">
        <span class="text-2xl font-bold">Username Dan Password Login</span>
        <hr>
        <br>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Username
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="username" type="text" placeholder="Nama" value="<?= $_SESSION['username'] ?>">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="text" placeholder="Password" value="">
        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Simpan</button>
    </form>

    <?php if (isset($_GET['update']) && $_GET['update'] == 'success') : ?>
        <p class="alert alert-success">Profile updated successfully!</p>
    <?php elseif (isset($_GET['update']) && $_GET['update'] == 'failed') : ?>
        <p class="alert alert-danger">Failed to update profile. Please try again.</p>
    <?php endif; ?>
</div>