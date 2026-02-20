<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Pencegahan Kekerasan (PPKPT) - Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#2563eb', // Blue 600 - Softer/Professional
                        secondary: '#1e293b', // Slate 800
                        darkbg: '#0f172a', // Slate 900
                        darkcard: '#1e293b', // Slate 800
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    <!-- Dark Mode Init Script -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-700 dark:bg-slate-900 dark:text-slate-300 transition-colors duration-300 antialiased">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50 dark:bg-slate-900/80 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-primary">PPKPT <span class="text-slate-700 dark:text-slate-400 font-semibold">Polije</span></span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-slate-600 hover:text-primary dark:text-slate-400 dark:hover:text-primary font-medium transition-colors">Beranda</a>
                    <a href="#lapor" class="text-slate-600 hover:text-primary dark:text-slate-400 dark:hover:text-primary font-medium transition-colors">Lapor</a>
                    
                    <!-- Theme Toggle Button -->
                    <button id="theme-toggle" class="p-2 text-slate-500 hover:text-primary dark:text-slate-400 dark:hover:text-primary focus:outline-none transition-colors rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                        <!-- Sun Icon -->
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <!-- Moon Icon -->
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <a href="../PPKPT/login" class="px-5 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500 transition-colors text-sm font-semibold shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-slate-900">Login Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-white py-16 lg:py-24 dark:bg-slate-900 transition-colors duration-300 relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-slate-100 dark:bg-grid-slate-800/[0.2] bg-[bottom_1px_center] opacity-40 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-medium text-sm mb-6 border border-blue-100 dark:border-blue-800">
                <span class="w-2 h-2 rounded-full bg-blue-500 mr-2 animate-pulse"></span>
                Satuan Tugas Pencegahan dan Penanganan Kekerasan di Perguruan Tinggi Politeknik Negeri Jember
            </div>
            <h1 class="text-4xl lg:text-6xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-6 leading-tight">
                Bersama Ciptakan Kampus <br class="hidden sm:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500 dark:from-blue-400 dark:to-indigo-400">Aman, Inklusif & Bebas Kekerasan</span>
            </h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-3xl mx-auto mb-10 leading-relaxed">
                Kami hadir untuk mendengar, melindungi, dan menindaklanjuti setiap bentuk kekerasan, perundungan (bullying), dan intoleransi demi kenyamanan seluruh sivitas akademika Politeknik Negeri Jember.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#form-lapor" class="px-8 py-4 bg-primary text-white rounded-xl font-bold shadow-lg shadow-blue-500/30 hover:bg-blue-700 transition-all transform hover:-translate-y-1 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Buat Laporan Sekarang
                </a>
                <a href="#info" class="px-8 py-4 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-xl font-bold hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors focus:ring-4 focus:ring-slate-200 dark:focus:ring-slate-800">
                    Pelajari Prosedur
                </a>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section id="form-lapor" class="py-20 bg-slate-50 dark:bg-slate-950 transition-colors duration-300">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-200 dark:border-slate-800 overflow-hidden transition-colors duration-300">
                <div class="bg-gradient-to-r from-slate-900 to-slate-800 dark:from-slate-800 dark:to-slate-900 px-8 py-8 border-b border-slate-800 dark:border-slate-700">
                    <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Formulir Pengaduan
                    </h2>
                    <p class="text-slate-400 mt-2 text-sm leading-relaxed">Silakan isi formulir di bawah ini dengan data yang sebenar-benarnya. Identitas pelapor akan dijaga kerahasiaannya sesuai kode etik.</p>
                </div>
                
                <form action="" method="POST" class="p-8 lg:p-10 space-y-8">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" required 
                            class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white dark:focus:bg-slate-800 transition-all placeholder-slate-400 dark:placeholder-slate-500 outline-none"
                            placeholder="Masukkan nama lengkap anda sesuai identitas">
                    </div>

                    <!-- NIM & NIK Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="nim" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">NIM (Nomor Induk Mahasiswa)</label>
                            <input type="text" id="nim" name="nim" required 
                                class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white dark:focus:bg-slate-800 transition-all placeholder-slate-400 dark:placeholder-slate-500 outline-none"
                                placeholder="Cth: E411xxxxx">
                        </div>
                        <div>
                            <label for="nik" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">NIK (KTP)</label>
                            <input type="text" id="nik" name="nik" required 
                                class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white dark:focus:bg-slate-800 transition-all placeholder-slate-400 dark:placeholder-slate-500 outline-none"
                                placeholder="16 digit NIK">
                        </div>
                    </div>

                    <!-- Kontak Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="hp" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nomor HP Aktif (WhatsApp)</label>
                            <input type="tel" id="hp" name="hp" required 
                                class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white dark:focus:bg-slate-800 transition-all placeholder-slate-400 dark:placeholder-slate-500 outline-none"
                                placeholder="Cth: 0812xxxxxxx">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Email Aktif</label>
                            <input type="email" id="email" name="email" required 
                                class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white dark:focus:bg-slate-800 transition-all placeholder-slate-400 dark:placeholder-slate-500 outline-none"
                                placeholder="nama@email.com">
                        </div>
                    </div>

                    <!-- Kronologi -->
                    <div>
                        <label for="kronologi" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kronologi Singkat Kejadian</label>
                        <div class="relative">
                            <textarea id="kronologi" name="kronologi" rows="6" required
                                class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white dark:focus:bg-slate-800 transition-all placeholder-slate-400 dark:placeholder-slate-500 outline-none resize-y"
                                placeholder="Ceritakan kejadian (Waktu, Lokasi, Pihak Terlibat, dan Deskripsi Peristiwa)..."></textarea>
                            <div class="absolute bottom-3 right-3 text-xs text-slate-400 dark:text-slate-500 pointer-events-none">Max 1000 kar.</div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-8 py-4 bg-primary text-white rounded-xl font-bold text-lg shadow-xl shadow-blue-500/20 hover:bg-blue-700 hover:shadow-blue-600/30 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 transition-all transform active:scale-[0.98]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Kirim Laporan
                        </button>
                        <p class="text-center text-xs text-slate-400 mt-4">Dengan mengirim laporan ini, saya menyatakan bahwa data yang saya berikan adalah benar.</p>
                    </div>
                </form>
            </div>
            
            <div class="mt-8 text-center p-6 bg-blue-50/50 dark:bg-blue-900/10 rounded-xl border border-blue-100 dark:border-blue-800/30 transition-colors duration-300">
                <p class="text-slate-600 dark:text-slate-400 text-sm font-medium">
                    <span class="font-bold text-blue-700 dark:text-blue-400">Butuh bantuan darurat?</span> Hubungi Call Center Satgas PPKS: <br>
                    <span class="text-2xl font-bold mt-2 block text-slate-800 dark:text-slate-200 tracking-wider">0812-3456-7890</span>
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 dark:bg-slate-900 dark:border-slate-800 py-10 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
            <div>
                <span class="text-lg font-bold text-slate-800 dark:text-slate-200">PPKPT Polije</span>
                <p class="text-slate-500 dark:text-slate-500 text-sm mt-1">© 2026 Satgas PPKS Politeknik Negeri Jember. <br class="md:hidden">All rights reserved.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-6 md:gap-8">
                <a href="#" class="text-slate-500 hover:text-primary dark:text-slate-500 dark:hover:text-slate-300 text-sm font-medium transition-colors">Privacy Policy</a>
                <a href="#" class="text-slate-500 hover:text-primary dark:text-slate-500 dark:hover:text-slate-300 text-sm font-medium transition-colors">Terms of Service</a>
                <a href="#" class="text-slate-500 hover:text-primary dark:text-slate-500 dark:hover:text-slate-300 text-sm font-medium transition-colors">Contact Us</a>
            </div>
        </div>
    </footer>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.theme) {
                if (localStorage.theme === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            } else {
                // if NOT set via local storage previously
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }
        });
    </script>

</body>
</html>