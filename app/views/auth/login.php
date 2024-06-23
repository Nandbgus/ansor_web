<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded-lg shadow-lg mt-8">
        <h1 class="text-2xl font-bold mb-4">Login</h1>
        <form action="<?= BASEURL ?>/auth/login" method="POST" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700"> Username:</label>
                <input type="text" name="username" id="id_login" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="password_login" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="password" name="password" id="password_login" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <input type="submit" value="Login" class="w-full justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            </div>
        </form>
    </div>
</div>
</div>