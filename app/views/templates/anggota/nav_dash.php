        <div class="h-full bg-gray-800 text-white w-3/4 md:w-1/4 absolute md:relative z-40 transform transition-transform duration-300 ease-in-out" :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen, 'md:translate-x-0': sidebarOpen || !sidebarOpen}">
            <div class="p-4 flex justify-between items-center">
                <h1 class="text-3xl font-bold"><a href="<?= BASEURL ?>/admin">DASHBOARD</a></h1>
                <div class="md:hidden" x-show="sidebarOpen">
                    <button @click="sidebarOpen = false" class="text-gray-300 hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <nav class="mt-4 p-2">
                <div class="p-4 gap-2" style="text-align: left;">
                    <label for="menu" style="text-transform: uppercase;" class="block text-md p-2 font-medium text-gray-400 uppercase">Menu</label>
                    <hr>
                    <a href="<?= BASEURL; ?>/anggota" class="block text-md hover:bg-gray-600 p-2 <?= ($data['current_page'] == 'Dashboard') ? ' text-white bg-gray-600' : 'text-gray-400  hover:text-white' ?>" aria-current="">Dashboard</a>
                    <a href="<?= BASEURL; ?>/anggota/sertifikat" class="mt-2 block text-md hover:bg-gray-600 p-2 <?= ($data['current_page'] == 'sertifikat_anggota') ? ' text-white bg-gray-600' : 'text-gray-400  hover:text-white' ?>" aria-current="">Form Pengajuan</a>
                    <hr>
                    <a href="<?= BASEURL; ?>/anggota/profile" class="block mt-2 text-md hover:bg-gray-600 p-2 <?= ($data['current_page'] == 'Profile_anggota') ? 'text-white bg-gray-600' : 'text-gray-400 hover:text-white' ?>" aria-current="">Profile</a>
                </div>
            </nav>
        </div>

        <main class="w-full h-full">
            <nav class="border shadow-md p-2 bg-white">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">
                        <div class="flex items-center">
                            <div class="md:hidden" x-show="!sidebarOpen">
                                <button @click="sidebarOpen = true" class="text-black hover:text-white focus:outline-none">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class=" md:flex items-center md:ml-6 gap-4">
                            <div class=" flex items-center md:ml-6 gap-4">
                                <!-- Dark Mode -->
                                <!-- Fitur Masih Belum bisa digunakan -->
                                <!-- <label :class="darkMode ? 'bg-primary' : 'bg-stroke'" class="relative m-0 block h-7.5 w-14 rounded-full bg-stroke">
                                    <button @click="toggleDarkMode" class="absolute top-0 z-50 m-0 h-full w-full cursor-pointer opacity-0"></button>

                                    <span :class="darkMode ? 'right-1 translate-x-full' : '!right-1 !translate-x-full'" class="absolute left-1 top-1/2 flex h-6 w-6 -translate-y-1/2 translate-x-0 items-center justify-center rounded-full bg-white shadow-switcher duration-75 ease-linear">
                                        <span class="dark:hidden">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            </svg>
                                        </span>
                                        <span class="hidden dark:inline-block">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            </svg>
                                        </span>
                                    </span>
                                </label> -->

                                <!-- Akhir Dari Fitur Dark -->
                                <button type=" button" class="relative rounded-full bg-gray-200 p-1.5 text-gray-500 border border-gray-300 hover:text-blue-500 focus:outline-none focus:ring-2  focus:ring-offset-1 ">
                                    <span class="sr-only">View notifications</span>
                                    <svg class="h-5 w-5 duration-300 ease-in-out" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                    </svg>
                                </button>
                                <button type="button" class="relative rounded-full bg-gray-200 p-1.5 text-gray-500 border border-gray-300 hover:text-blue-500 focus:outline-none focus:ring-2  focus:ring-offset-1 ">
                                    <span class="sr-only">View notifications</span>
                                    <svg class="fill-current duration-300 ease-in-out" stroke-width="0.2" stroke="currentColor" width="20" height="20" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.9688 1.57495H7.03135C3.43135 1.57495 0.506348 4.41558 0.506348 7.90308C0.506348 11.3906 2.75635 13.8375 8.26885 16.3125C8.40947 16.3687 8.52197 16.3968 8.6626 16.3968C8.85947 16.3968 9.02822 16.3406 9.19697 16.2281C9.47822 16.0593 9.64697 15.75 9.64697 15.4125V14.2031H10.9688C14.5688 14.2031 17.522 11.3625 17.522 7.87495C17.522 4.38745 14.5688 1.57495 10.9688 1.57495ZM10.9688 12.9937H9.3376C8.80322 12.9937 8.35322 13.4437 8.35322 13.9781V15.0187C3.6001 12.825 1.74385 10.8 1.74385 7.9312C1.74385 5.14683 4.10635 2.8687 7.03135 2.8687H10.9688C13.8657 2.8687 16.2563 5.14683 16.2563 7.9312C16.2563 10.7156 13.8657 12.9937 10.9688 12.9937Z" fill=""></path>
                                        <path d="M5.42812 7.28442C5.0625 7.28442 4.78125 7.56567 4.78125 7.9313C4.78125 8.29692 5.0625 8.57817 5.42812 8.57817C5.79375 8.57817 6.075 8.29692 6.075 7.9313C6.075 7.56567 5.79375 7.28442 5.42812 7.28442Z" fill=""></path>
                                        <path d="M9.00015 7.28442C8.63452 7.28442 8.35327 7.56567 8.35327 7.9313C8.35327 8.29692 8.63452 8.57817 9.00015 8.57817C9.33765 8.57817 9.64702 8.29692 9.64702 7.9313C9.64702 7.56567 9.33765 7.28442 9.00015 7.28442Z" fill=""></path>
                                        <path d="M12.5719 7.28442C12.2063 7.28442 11.925 7.56567 11.925 7.9313C11.925 8.29692 12.2063 8.57817 12.5719 8.57817C12.9375 8.57817 13.2188 8.29692 13.2188 7.9313C13.2188 7.56567 12.9094 7.28442 12.5719 7.28442Z" fill=""></path>
                                    </svg>
                                </button>
                                <div class="profile flex justify-center align-middle">
                                    <div class="flex items-center space-x-4 pl-2">
                                        <div class="text-sm font-normal text-gray-700">
                                            <?= $_SESSION['user_name'];
                                            ?>
                                            <div class="text-sm text-right text-gray-500 font-light">
                                                <?= $_SESSION['is_admin'] === 1 ? 'Admin' : 'User' ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Profile dropdown -->
                                    <div class="relative ml-3" x-data="{ open: false }">
                                        <div>
                                            <!-- Tampilkan tombol login jika pengguna belum login -->
                                            <?php if (!isset($_SESSION['user_id'])) : ?>
                                                <div class="relative ml-3" x-data="{ open: false }">
                                                    <div>
                                                        <button @click="open = !open" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                                            <span class="absolute -inset-1.5"></span>
                                                            <span class="sr-only">Open user menu</span>
                                                            <img class="h-8 w-8 rounded-full" src="https://static.vecteezy.com/system/resources/previews/026/530/349/non_2x/anonymous-person-silhouette-icon-vector.jpg" alt="">
                                                        </button>
                                                    </div>
                                                    <!-- Dropdown -->
                                                    <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1  ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                                        <a href="<?= BASEURL; ?>/auth/login" class="block px-4 py-2 text-sm text-gray-700 hover:underline " role="menuitem" tabindex="-1" id="user-menu-item-0">Log In</a>
                                                    </div>
                                                </div>
                                            <?php else : ?>


                                                <!-- Tampilkan dropdown profil jika pengguna sudah login -->
                                                <button @click="open = !open" type="button" class="relative flex max-w-md items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                                    <span class="absolute -inset-1.5"></span>
                                                    <span class="sr-only">Open user menu</span>
                                                    <img class="h-12 w-12 rounded-full" src="<?= BASEURL ?>/img/profile/<?= $data['foto'] ?>" alt="">
                                                </button>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Tampilkan dropdown menu jika pengguna sudah login -->
                                        <div x-show="open" @click.away="open = false" class="duration-300 ease-in-out absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                            <?php if (isset($_SESSION['user_id'])) : ?>
                                                <!-- Tampilkan menu dropdown jika pengguna sudah login -->
                                                <a href="<?= BASEURL ?>/auth/profile" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                                                <a href="<?= BASEURL; ?>/auth/logout" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </nav>
            <!-- content -->
            <div class="flex-grow p-8 h-full lg:h-[30rem] md:h-full isi overflow-y-scroll">
                <!-- Breadcrumbs -->
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="<?= BASEURL ?>/anggota" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                </svg>
                                Anggota
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"><?= $data['head'] ?></span>
                            </div>
                        </li>
                    </ol>
                </nav>