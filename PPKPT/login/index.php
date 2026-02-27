<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PPKPT Polije</title>
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
                        primary: '#2563eb', // Blue 600
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
<body class="bg-slate-200 text-slate-800 dark:bg-slate-950 dark:text-slate-200 min-h-screen flex flex-col transition-colors duration-300 antialiased">

    <!-- Navbar (Simplified) -->
    <nav class="bg-white border-b border-slate-200 dark:bg-slate-900 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="../index.php" class="text-2xl font-bold text-primary">PPKPT <span class="text-slate-700 dark:text-slate-400 font-semibold">Polije</span></a>
                </div>
                <div class="flex items-center space-x-4">
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

                    <a href="../index.php" class="text-sm text-slate-500 hover:text-primary dark:text-slate-400 dark:hover:text-primary flex items-center gap-1 transition-colors font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <main class="flex-grow flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white dark:bg-slate-900 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 overflow-hidden transition-colors duration-300">
            <div class="p-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Login Administrator</h2>
                    <p class="text-slate-500 dark:text-slate-400 mt-2">Masuk untuk mengelola laporan.</p>
                </div>

                <form action="" method="POST" class="space-y-6">
                    <div>
                        <label for="username" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Username / NIP</label>
                        <input type="text" id="username" name="username" required 
                            class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white dark:focus:bg-slate-800 transition-all placeholder-slate-400 dark:placeholder-slate-500 outline-none"
                            placeholder="Masukkan username anda">
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Password</label>
                            <a href="#" class="text-xs text-primary hover:underline hover:text-blue-700 dark:hover:text-blue-400 transition-colors">Lupa password?</a>
                        </div>
                        <input type="password" id="password" name="password" required 
                            class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white dark:focus:bg-slate-800 transition-all placeholder-slate-400 dark:placeholder-slate-500 outline-none"
                            placeholder="••••••••">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full px-4 py-3 bg-primary text-white rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/20 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 transition-all transform active:scale-[0.98]">
                            Masuk Dashboard
                        </button>
                    </div>
                </form>
            </div>
            <div class="bg-slate-50 dark:bg-slate-800/50 px-8 py-4 border-t border-slate-100 dark:border-slate-800 text-center transition-colors duration-300">
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Akses terbatas hanya untuk Satgas PPKT Politeknik Negeri Jember.
                </p>
            </div>
        </div>
    </main>

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
