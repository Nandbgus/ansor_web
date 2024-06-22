        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $data['head'] ?></title>
            <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.0/dist/cdn.min.js"></script>
            <link rel="stylesheet" href="/ansor/public/css/output.css">
            <!-- Masukkan Alpine.js -->
            <!-- <script src="/ansor/public/js/alphine.js" defer></script> -->
            <script src="/ansor/public/js/searchFilter.js" defer></script>
            <!-- <script src="https://cdn.tailwindcss.com"></script> -->

            <style>
                .artikel-judul::before {
                    content: "";
                    position: absolute;
                    margin-top: 20px;
                    left: 0;
                    z-index: -1;
                    width: 40%;
                    height: 4px;
                    /* Ketebalan garis */
                    background-color: #EF4444;
                    /* Warna garis */
                }

                .artikel-judul::after {
                    content: "";
                    position: absolute;
                    margin-top: 20px;
                    right: 0;
                    z-index: -1;
                    width: 40%;
                    height: 4px;
                    /* Ketebalan garis */
                    background-color: #EF4444;
                    /* Warna garis */
                }
            </style>
        </head>

        <body class="h-full bg-gray-100">
            <div class="min-h-full" x-data="{open:false}">
                <div x-data="{ mobileMenuOpen: false, userMenuOpen: false }" class="bg-gray-800">
                    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                        <div class="relative flex h-16 items-center justify-between">
                            <!-- Mobile menu button -->
                            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                                    <span class="absolute -inset-0.5"></span>
                                    <span class="sr-only">Open main menu</span>
                                    <!-- Icon when menu is closed -->
                                    <svg x-show="!mobileMenuOpen" class="block h-6 w-6 ease-in  " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                    </svg>
                                    <!-- Icon when menu is open -->
                                    <svg x-show="mobileMenuOpen" class="block h-6 w-6 ease-in-out text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>

                                </button>
                            </div>

                            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">

                                <!-- Desktop Menu -->
                                <div class="hidden sm:ml-6 sm:block">
                                    <div class="flex space-x-4">
                                        <!-- Menu Items -->
                                        <?php
                                        $current_page = basename($_SERVER['REQUEST_URI'], ".php");
                                        ?>
                                        <a href="<?= BASEURL; ?>/" class="<?= ($data['current_page'] == 'Home' || $data['current_page'] == 'index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
                                        <a href="<?= BASEURL; ?>/blog" class="<?= ($data['current_page'] == 'Blog' || $data['current_page'] == 'blog') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Blog</a>
                                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) : ?>
                                            <a href="<?= BASEURL; ?>/admin/dashboard" class="<?= ($data['current_page'] == 'dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Dashboard (Admin)</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Right-hand side icons -->
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                                <!-- Notifications button -->
                                <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">View notifications</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0">
                                        </path>
                                    </svg>
                                </button>

                                <!-- Profile dropdown -->
                                <div class="relative ml-3" x-data="{ open: false }">
                                    <div>
                                        <!-- Tombol login jika belum login -->
                                        <?php if (!isset($_SESSION['user_id'])) : ?>
                                            <div class="relative ml-3" x-data="{ open: false }">
                                                <div>
                                                    <button @click="open = !open" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                                        <span class="absolute -inset-1.5"></span>
                                                        <span class="sr-only">Open user menu</span>
                                                        <img class="h-8 w-8 rounded-full" src="<?= BASEURL ?>/img/profile/anyms.jpg" alt="">
                                                    </button>
                                                </div>
                                                <!-- Dropdown -->
                                                <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                                    <a href="<?= BASEURL; ?>/auth/login" class="block px-4 py-2 text-sm text-gray-700 hover:underline " role="menuitem" tabindex="-1" id="user-menu-item-0">Log In</a>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <!-- Dropdown profil jika sudah login -->
                                            <button @click="open = !open" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                                <span class="absolute -inset-1.5"></span>
                                                <span class="sr-only">Open user menu</span>
                                                <img class="h-8 w-8 rounded-full" src="<?= BASEURL ?>/img/profile/<?= $data['foto'] ?>" alt="">
                                            </button>
                                            <!-- Dropdown menu jika pengguna sudah login -->
                                            <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                                <?php if (isset($_SESSION['user_id'])) : ?>
                                                    <a href="<?= BASEURL ?>/auth/profile" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                                                    <a href="<?= BASEURL; ?>/auth/logout" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile menu -->
                    <div x-show="mobileMenuOpen" class="sm:hidden" id="mobile-menu">
                        <div class="space-y-1 px-2 pb-3 pt-2">
                            <!-- Menu Items -->
                            <a href="<?= BASEURL; ?>/" class="<?= ($data['current_page'] == 'Home' || $data['current_page'] == 'index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Home</a>
                            <a href="<?= BASEURL; ?>/blog" class="<?= ($data['current_page'] == 'Blog' || $data['current_page'] == 'blog') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Blog</a>
                            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) : ?>
                                <a href="<?= BASEURL; ?>/admin/dashboard" class="<?= ($data['current_page'] == 'dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> block rounded-md px-3 py-2 text-base font-medium">Dashboard (Admin)</a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>


                <!-- Menandai halaman -->
                <header class="bg-white shadow">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        <h1 class="text-3xl font-bold tracking-tight text-gray-900"><?= $data['head'] ?></h1>
                    </div>
                </header>

                <main class="p-8">

                    <!-- Halaman TEST -->