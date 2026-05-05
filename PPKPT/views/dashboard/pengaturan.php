<?php
       ob_start();
?>
<?php $page = 'pengaturan' ?>
    <body class="bg-slate-50 text-slate-800 dark:bg-slate-900 dark:text-slate-200 transition-colors duration-300 antialiased overflow-hidden">

        <div class="flex h-screen overflow-hidden">

            <!-- Main Content -->
            <main class="flex-1 flex flex-col min-w-0 bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
                <!-- Topbar -->
                <header class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 sticky top-0 z-40 transition-colors duration-300">
                    <button id="sidebar-toggle" class="lg:hidden p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="flex-1 flex justify-between items-center ml-4 lg:ml-0">
                        <h1 class="text-xl font-semibold text-slate-800 dark:text-white truncate">Dashboard Overview</h1>

                        <div class="flex items-center space-x-4">
                            <!-- Theme Toggle -->
                            <button id="theme-toggle" class="p-2 text-slate-500 hover:text-primary dark:text-slate-400 dark:hover:text-primary rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 focus:outline-none transition-colors">
                                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>
                            </button>

                            <!-- User Profile Dropdown (Simplified) -->
                            <div class="relative">
                                <button class="flex items-center max-w-xs bg-white dark:bg-slate-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-slate-900" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 font-bold">
                                        A
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Dashboard Content -->
                <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">

                    <main class="flex-1 flex flex-col min-w-0 bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
                        <div class="flex-1 overflow-y-auto ">
                            <div class="mb-8">
                        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Profile Pengguna</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400"> Kelola informasi dasar, keamanan akun, dan pengaturan sistem dengan mudah melalui panel administrasi.</p>
                   
                    </div>
                            <div class=" mx-auto space-y-6">

                                <div class="bg-white dark:bg-slate-800 shadow rounded-lg border border-slate-100 dark:border-slate-700">
                                    <div class="px-4 py-5 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                                        <div>
                                            <h3 class="text-lg font-medium text-slate-900 dark:text-white">Informasi Profil</h3>
                                            <p class="text-sm text-slate-500 dark:text-slate-400">Kelola informasi dasar akun Anda.</p>
                                        </div>
                                        <button onclick="openModal('edit-profile-modal')" class="text-primary hover:text-blue-700 text-sm font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                            Edit Profil
                                        </button>
                                    </div>
                                    <div class="p-6">
                                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                            <div>
                                                <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Nama Lengkap</dt>
                                                <dd class="mt-1 text-sm text-slate-900 dark:text-white font-semibold">Admin PPKPT Polije</dd>
                                            </div>
                                            <div>
                                                <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Email</dt>
                                                <dd class="mt-1 text-sm text-slate-900 dark:text-white font-semibold">admin@polije.ac.id</dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>

                                <div class="bg-white dark:bg-slate-800 shadow rounded-lg border border-slate-100 dark:border-slate-700">
                                    <div class="p-6 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="p-3 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 mr-4">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-bold text-slate-900 dark:text-white">Kata Sandi</h3>
                                                <p class="text-xs text-slate-500">Terakhir diubah 2 bulan yang lalu</p>
                                            </div>
                                        </div>
                                        <button onclick="openModal('change-password-modal')" class="bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 text-slate-700 dark:text-slate-200 px-4 py-2 rounded-md text-sm transition-colors">Ganti Password</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </main>
                </div>
            </main>
        </div>

        <div id="modal-backdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-50 hidden" aria-hidden="true"></div>

        <div id="edit-profile-modal" class="hidden fixed z-50 inset-0 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200 dark:border-slate-700">
                    <form onsubmit="event.preventDefault(); closeModal('edit-profile-modal'); alert('Profil berhasil diperbarui!');">
                        <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-4">Edit Profil Admin</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Lengkap</label>
                                    <input type="text" value="Admin PPKPT Polije" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 dark:text-white py-2 px-3 focus:ring-primary focus:border-primary shadow-sm" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Email</label>
                                    <input type="email" value="admin@polije.ac.id" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 dark:text-white py-2 px-3 focus:ring-primary focus:border-primary shadow-sm" required>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">Simpan Perubahan</button>
                            <button type="button" onclick="closeModal('edit-profile-modal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-slate-600 px-4 py-2 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="change-password-modal" class="hidden fixed z-50 inset-0 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full border border-slate-200 dark:border-slate-700">
                    <form onsubmit="event.preventDefault(); closeModal('change-password-modal'); alert('Password berhasil diubah!');">
                        <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-4">Ganti Password</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Password Saat Ini</label>
                                    <input type="password" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 dark:text-white py-2 px-3 shadow-sm focus:ring-primary" required>
                                </div>
                                <hr class="border-slate-200 dark:border-slate-700">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Password Baru</label>
                                    <input type="password" name="password" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 dark:text-white py-2 px-3 shadow-sm focus:ring-primary" required>
                                </div>
                                <hr class="border-slate-200 dark:border-slate-700">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Konfirmasi Password Baru</label>
                                    <input type="password" name="confirm_password" class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 dark:text-white py-2 px-3 shadow-sm focus:ring-primary" required>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">Update Password</button>
                            <button type="button" onclick="closeModal('change-password-modal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- View Detail Modal -->


        <!-- Script Logic -->
        <script>
            // Modal & Toggle Logic
            const backdrop = document.getElementById('modal-backdrop');

            function openModal(modalId) {
                document.getElementById(modalId).classList.remove('hidden');
                backdrop.classList.remove('hidden');
                // Prevent body scroll
                document.body.style.overflow = 'hidden';
            }

            function closeModal(modalId) {
                document.getElementById(modalId).classList.add('hidden');
                backdrop.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            // Specific Openers (simulated)
            function openEditModal(id) {
                openModal('edit-modal');
            }

            function openDeleteModal(id) {
                openModal('delete-modal');
            }

            function openViewModal(id) {
                openModal('view-modal');
            }

            // Close when clicking backdrop
            backdrop.addEventListener('click', () => {
                document.querySelectorAll('[role="dialog"]').forEach(el => {
                    if (!el.classList.contains('hidden')) {
                        el.classList.add('hidden');
                    }
                });
                backdrop.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });

            // Theme Toggle Logic
            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
            var themeToggleBtn = document.getElementById('theme-toggle');

            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon.classList.remove('hidden');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
            }

            themeToggleBtn.addEventListener('click', function() {
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');

                if (localStorage.theme) {
                    if (localStorage.theme === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    }
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    }
                }
            });

            // Mobile Sidebar Toggle
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            let isSidebarOpen = false;

            sidebarToggle.addEventListener('click', () => {
                // In mobile, transform controls visibility
                if (isSidebarOpen) {
                    sidebar.classList.add('-translate-x-full');
                } else {
                    sidebar.classList.remove('-translate-x-full');
                }
                isSidebarOpen = !isSidebarOpen;
            });
        </script>
<?php
   $content = ob_get_clean();
        include __DIR__ . '/../layouts/main.php';
?>