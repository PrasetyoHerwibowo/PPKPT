<?php
require_once '../../auth/check_session.php';
check_role(['superadmin']);

$pdo = require '../../config/connection.php';

$page = 'pengaturan';
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - PPKPT Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { primary: '#2563eb' }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-50 text-slate-800 dark:bg-slate-900 dark:text-slate-200 antialiased overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        <?php include '../partials/sidebar.php'; ?>

        <main class="flex-1 flex flex-col min-w-0 bg-slate-50 dark:bg-slate-900">
            <header class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 h-16 flex items-center px-8">
                <h1 class="text-xl font-semibold">Pengaturan Sistem</h1>
            </header>

            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white dark:bg-slate-800 shadow rounded-lg p-6 mb-6">
                        <h2 class="text-lg font-medium mb-4">Profil Instansi</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Nama Aplikasi</label>
                                <input type="text" value="PPKPT Polije" class="w-full rounded-md border-slate-300 dark:bg-slate-700 py-2 px-3">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Email Kontak</label>
                                <input type="email" value="satgas@polije.ac.id" class="w-full rounded-md border-slate-300 dark:bg-slate-700 py-2 px-3">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-800 shadow rounded-lg p-6">
                        <h2 class="text-lg font-medium mb-4">Keamanan</h2>
                        <p class="text-sm text-slate-500 mb-4">Pengaturan verifikasi sesi aktif.</p>
                        <div class="flex items-center justify-between">
                            <span>Verifikasi Real-time</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold rounded">AKTIF</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
