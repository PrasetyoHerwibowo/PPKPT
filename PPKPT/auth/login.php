<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pdo = require '../config/connection.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            if ($user['status'] !== 'aktif') {
                $error = "Akun anda telah dinonaktifkan!";
            } else {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['nama'] = $user['nama'];

                // Redirect to dashboard
                header("Location: ../admin/dashboard/index.php");
                exit();
            }
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Silakan isi semua kolom!";
    }
}
?>
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
                <div class="flex items-end space-x-4">
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

                <?php if ($error): ?>
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 dark:bg-red-900/20 dark:text-red-400 rounded-r-lg animate-pulse" role="alert">
                        <p class="text-sm font-medium"><?= $error ?></p>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" class="space-y-6">
                    <div>
                        <label for="username" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Username / NIP</label>
                        <input type="text" id="username" name="username" required 
                            class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white dark:focus:bg-slate-800 transition-all placeholder-slate-400 dark:placeholder-slate-500 outline-none"
                            placeholder="Masukkan username anda">
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <label for="password" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Password</label>
                            <a href="#" class="text-xs text-primary hover:underline font-medium">Lupa Password?</a>
                        </div>
                        <input type="password" id="password" name="password" required 
                            class="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-primary focus:bg-white dark:focus:bg-slate-800 transition-all placeholder-slate-400 dark:placeholder-slate-500 outline-none"
                            placeholder="••••••••">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" class="h-4 w-4 text-primary focus:ring-primary border-slate-300 rounded transition-colors">
                        <label for="remember" class="ml-2 block text-sm text-slate-600 dark:text-slate-400 font-medium">Ingat Saya</label>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg shadow-blue-500/30 transform active:scale-[0.98] transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900">
                        Masuk Ke Dashboard
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 text-center">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Kesulitan Masuk? <a href="#" class="text-primary hover:underline font-semibold">Hubungi Tim IT</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="p-6 text-center text-slate-500 dark:text-slate-400 text-sm">
        <p>&copy; 2024 Satgas PPKPT Polije. All rights reserved.</p>
    </footer>

    <script>
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
    </script>
</body>
</html>
