<?php
$pdo = require '../../config/connection.php';

// Ambil data laporan
$sql = "SELECT * FROM laporan ORDER BY tanggal DESC";
$stmt = $pdo->query($sql);
$laporan = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Hitung statistik
$totalLaporan = count($laporan);
$pending = 0;
$diproses = 0;
$selesai = 0;

foreach ($laporan as $row) {
    if ($row['status'] == 'Pending') $pending++;
    elseif ($row['status'] == 'Diproses') $diproses++;
    elseif ($row['status'] == 'Selesai') $selesai++;
}
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PPKPT Polije</title>
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
                        primary: '#2563eb',
                        secondary: '#1e293b',
                        darkbg: '#0f172a',
                        darkcard: '#1e293b',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom scrollbar for better look */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background-color: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 4px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background-color: #475569;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8;
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            background-color: #64748b;
        }
    </style>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<?php $page = 'dashboard'; ?>
<body class="bg-slate-50 text-slate-800 dark:bg-slate-900 dark:text-slate-200 transition-colors duration-300 antialiased ">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <?php include '../partials/sidebar.php'; ?>

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

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                    <!-- Total Laporan -->
                    <div class="bg-white dark:bg-slate-800 overflow-hidden shadow rounded-lg border border-slate-100 dark:border-slate-700 transition-colors">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900/30 rounded-md p-3">
                                    <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-slate-500 dark:text-slate-400 truncate">Total Laporan</dt>
                                        <dd class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $totalLaporan ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending -->
                    <div class="bg-white dark:bg-slate-800 overflow-hidden shadow rounded-lg border border-slate-100 dark:border-slate-700 transition-colors">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-100 dark:bg-yellow-900/30 rounded-md p-3">
                                    <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-slate-500 dark:text-slate-400 truncate">Perlu Diproses</dt>
                                        <dd class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $pending ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- On Process -->
                    <div class="bg-white dark:bg-slate-800 overflow-hidden shadow rounded-lg border border-slate-100 dark:border-slate-700 transition-colors">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-sky-100 dark:bg-sky-900/30 rounded-md p-3">
                                    <svg class="h-6 w-6 text-sky-600 dark:text-sky-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-slate-500 dark:text-slate-400 truncate">Sedang Diproses</dt>
                                        <dd class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $diproses ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Done -->
                    <div class="bg-white dark:bg-slate-800 overflow-hidden shadow rounded-lg border border-slate-100 dark:border-slate-700 transition-colors">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-100 dark:bg-green-900/30 rounded-md p-3">
                                    <svg class="h-6 w-6 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-slate-500 dark:text-slate-400 truncate">Selesai</dt>
                                        <dd class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $selesai ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports Table Section -->
                <div class="bg-white dark:bg-slate-800 shadow rounded-lg border border-slate-100 dark:border-slate-700/50 mb-8 transition-colors">
                    <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-700 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-white">Daftar Laporan Masuk</h3>
                        <div class="flex space-x-3 w-full sm:w-auto">
                            <div class="relative rounded-md shadow-sm w-full sm:w-64">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="search" id="search" class="focus:ring-primary focus:border-primary block w-full pl-10 sm:text-sm border-slate-300 dark:border-slate-600 rounded-md bg-slate-50 dark:bg-slate-700/50 dark:text-white py-2" placeholder="Cari laporan...">
                            </div>
                            <button onclick="openModal('add-modal')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-slate-900 transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Tambah
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                            <thead class="bg-slate-50 dark:bg-slate-700/50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pelapor</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kategori</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-200 dark:divide-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <?php $no = 1; ?>
                                <?php foreach ($laporan as $row): ?>

                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30">

                                        <td class="px-6 py-4 text-sm text-slate-500">
                                            <?= $no++ ?>
                                        </td>

                                        <td class="px-6 py-4 text-sm text-slate-900 dark:text-white">
                                            <?= $row['tanggal'] ?>
                                        </td>

                                        <td class="px-6 py-4">

                                            <div class="text-sm font-medium text-slate-900 dark:text-white">
                                                <?= $row['nama'] ?>
                                            </div>

                                            <div class="text-xs text-slate-500">
                                                <?= $row['nim'] ?>
                                            </div>

                                        </td>

                                        <td class="px-6 py-4 text-sm text-slate-500">
                                            <?= $row['tkp'] ?>
                                        </td>

                                        <td class="px-6 py-4">
                                            <?php

                                            $status = $row['status'];

                                            if ($status == "Pending") {
                                                $color = "bg-yellow-100 text-yellow-800";
                                            } elseif ($status == "Diproses") {
                                                $color = "bg-blue-100 text-blue-800";
                                            } else {
                                                $color = "bg-green-100 text-green-800";
                                            }

                                            ?>

                                            <span class="px-2 inline-flex text-xs font-semibold rounded-full <?= $color ?>">
                                                <?= $row['status'] ?>
                                            </span>

                                        </td>

                                        <td class="px-6 py-4 text-right text-sm font-medium space-x-2">

                                            <button onclick='openViewModal(
                                                <?= json_encode($row['nama']) ?>,
                                                <?= json_encode($row['nim']) ?>,
                                                <?= json_encode($row['hp']) ?>,
                                                <?= json_encode($row['email']) ?>,
                                                <?= json_encode($row['kronologi']) ?>,
                                                <?= json_encode($row['tkp']) ?>,
                                                <?= json_encode($row['bukti']) ?>,
                                                <?= json_encode($row['status']) ?>,
                                                <?= json_encode($row['catatan_admin']) ?>
                                            )' class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                                <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Detail
                                            </button>

                                            <button onclick='openEditModal(
                                                <?= json_encode($row['id']) ?>,
                                                <?= json_encode($row['status']) ?>,
                                                <?= json_encode($row['catatan_admin']) ?>
                                            )' class="text-amber-600 hover:text-amber-900 dark:text-amber-400 dark:hover:text-amber-300 transition-colors">
                                                <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </button>

                                            <button onclick="openDeleteModal(<?= $row['id'] ?>)" class="text-red-600">
                                                Hapus
                                            </button>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination (Static) -->
                    <div class="bg-white dark:bg-slate-800 px-4 py-3 border-t border-slate-200 dark:border-slate-700 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-slate-300 text-sm font-medium rounded-md text-slate-700 bg-white hover:bg-slate-50">Previous</a>
                            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-slate-300 text-sm font-medium rounded-md text-slate-700 bg-white hover:bg-slate-50">Next</a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-slate-700 dark:text-slate-400">
                                    Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium"><?= min(10, $totalLaporan) ?></span> dari <span class="font-medium"><?= $totalLaporan ?></span> hasil
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-sm font-medium text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700">
                                        <span class="sr-only">Previous</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="#" aria-current="page" class="z-10 bg-blue-50 dark:bg-blue-900/50 border-primary text-primary relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</a>
                                    <a href="#" class="bg-white dark:bg-slate-800 border-slate-300 dark:border-slate-600 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium">2</a>
                                    <a href="#" class="bg-white dark:bg-slate-800 border-slate-300 dark:border-slate-600 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium">3</a>
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-sm font-medium text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700">
                                        <span class="sr-only">Next</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Backdrop -->
    <div id="modal-backdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-50 hidden" aria-hidden="true"></div>

    <!-- Add Report Modal -->
    <div id="add-modal" class="hidden fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200 dark:border-slate-700">
                <form action="../../laporan/proses_laporan.php" method="POST">
                    <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-white" id="modal-title">Tambah Laporan Baru</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Pelapor</label>
                                        <input type="text" name="nama" class="w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-slate-200 dark:bg-slate-700 dark:text-white py-2 px-3" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">NIM / NIP (Opsional)</label>
                                        <input type="text" name="nim" class="w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-slate-200 dark:bg-slate-700 dark:text-white py-2 px-3">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">NIK</label>
                                        <input type="text" name="nik" class="w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-slate-200 dark:bg-slate-700 dark:text-white py-2 px-3">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">No Telepon</label>
                                        <input type="text" name="hp" class="w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-slate-200 dark:bg-slate-700 dark:text-white py-2 px-3">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Email</label>
                                        <input type="text" name="email" class="w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-slate-200 dark:bg-slate-700 dark:text-white py-2 px-3">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">TKP</label>
                                        <input type="text" name="tkp" class="w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-slate-200 dark:bg-slate-700 dark:text-white py-2 px-3">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Bukti</label>
                                        <input type="text" name="bukti" class="w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-slate-200 dark:bg-slate-700 dark:text-white py-2 px-3">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tanggal dan Waktu</label>
                                        <input type="date" name="tanggal" class="w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-slate-200 dark:bg-slate-700 dark:text-white py-2 px-3">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Deskripsi Kejadian</label>
                                        <textarea rows="3" name="kronologi" class="w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-slate-200 dark:bg-slate-700 dark:text-white py-2 px-3" required></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status Awal</label>
                                        <select name="status" class="w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-slate-200 dark:bg-slate-700 dark:text-white py-2 px-3">
                                            <option value="pending">Pending</option>
                                            <option value="process">Di Proses</option>
                                            <option value="done">Selesai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                        <button type="button" onclick="closeModal('add-modal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Edit -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-slate-800">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-4">Update Status Laporan</h3>
                <form action="../../laporan/update_status.php" method="POST">
                    <!-- Hidden ID -->
                    <input type="hidden" name="id" id="edit_id">

                    <div class="mb-4 ">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Status</label>
                        <select name="status" id="edit_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-slate-700 dark:text-white py-2 px-3">
                            <option value="Pending">Pending</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Catatan Admin</label>
                        <textarea name="catatan_admin" id="edit_catatan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-slate-700 dark:text-white"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="hidden fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200 dark:border-slate-700">
                <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-white" id="modal-title">Hapus Laporan</h3>
                            <div class="mt-2">
                                <p class="text-sm text-slate-500 dark:text-slate-400">Apakah anda yakin ingin menghapus laporan ini? Data yang dihapus tidak dapat dikembalikan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="confirmDelete()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Hapus</button>
                    <button type="button" onclick="closeModal('delete-modal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Detail Modal -->
    <div id="view-modal" class="hidden fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full border border-slate-200 dark:border-slate-700">
                <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl leading-6 font-bold text-slate-900 dark:text-white" id="modal-title">Detail Laporan #FR-2024-001</h3>
                                <span id="view-status" class="px-2 align-top inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300"></span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-600 dark:text-slate-300 mb-6">
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">Pelapor:</p>
                                    <p>Nama: <span id="view-nama"></span></p>
                                    <p>NIM: <span id="view-nim"></span></p>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">Kontak:</p>
                                    <p>No-Telepon: <span id="view-hp"></span></p>
                                    <p>Email: <span id="view-email"></span></p>
                                </div>

                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white mt-2">Kategori:</p>
                                    <p>Perundungan/Bullying</p>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">Lokasi: </p>
                                    <p>Tempat Perkara: <span id="view-tkp"></span></p>
                                    <p>Butkti Pendukung: <span id="view-bukti"></span></p>
                                </div>
                                <div class="md:col-span-2 bg-slate-50 dark:bg-slate-700/30 p-3 rounded-lg border border-slate-100 dark:border-slate-700/50">
                                    <p class="font-semibold text-slate-900 dark:text-white mb-1">Kronologi Kejadian:</p>
                                    <p id="view-kronologi" class="italic">""</p>
                                </div>
                                <div class="md:col-span-2 bg-slate-50 dark:bg-slate-700/30 p-3 rounded-lg border border-slate-100 dark:border-slate-700/50">
                                    <p class="font-semibold text-slate-900 dark:text-white mb-1">Catatan Admin: </p>
                                    <p id="view-catatan"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeModal('view-modal')" class="w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">Tutup</button>
                    <button type="button" onclick="closeModal('view-modal'); openEditModal('1');" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Tindak Lanjuti</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Logic -->
    <script>
        // Modal & Toggle Logic
        const backdrop = document.getElementById('modal-backdrop');
        let currentDeleteId = null;

        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            backdrop.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            // Cek apakah masih ada modal terbuka
            const openModals = document.querySelectorAll('[role="dialog"]:not(.hidden)');
            if (openModals.length === 0) {
                backdrop.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        // Function untuk Edit Modal
        function openEditModal(id, status, catatan) {
            document.getElementById("edit_id").value = id;
            document.getElementById("edit_status").value = status;
            document.getElementById("edit_catatan").value = catatan || '';
            document.getElementById("editModal").classList.remove("hidden");
            backdrop.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById("editModal").classList.add("hidden");
            backdrop.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Function untuk Delete Modal
        function openDeleteModal(id) {
            currentDeleteId = id;
            openModal('delete-modal');
        }

        function confirmDelete() {
            if (currentDeleteId) {
                // Redirect ke halaman delete
                window.location.href = '../../laporan/delete_laporan.php?id=' + currentDeleteId;
            }
            closeModal('delete-modal');
        }

        // Function untuk View Modal
        function openViewModal(nama, nim, hp, email, kronologi, tkp, bukti, status, catatan) {
            document.getElementById("view-nama").innerText = nama || '-';
            document.getElementById("view-nim").innerText = nim || '-';
            document.getElementById("view-hp").innerText = hp || '-';
            document.getElementById("view-email").innerText = email || '-';
            document.getElementById("view-kronologi").innerText = kronologi || '-';
            document.getElementById("view-tkp").innerText = tkp || '-';
            document.getElementById("view-bukti").innerText = bukti || '-';
            document.getElementById("view-status").innerText = status || '-';
            document.getElementById("view-catatan").innerText = catatan || '-';

            // Set warna status
            const statusElement = document.getElementById("view-status");
            statusElement.className = 'px-2 align-top inline-flex text-xs leading-5 font-semibold rounded-full';

            if (status === 'Pending') {
                statusElement.classList.add('bg-yellow-100', 'text-yellow-800', 'dark:bg-yellow-900/50', 'dark:text-yellow-300');
            } else if (status === 'Diproses') {
                statusElement.classList.add('bg-blue-100', 'text-blue-800', 'dark:bg-blue-900/50', 'dark:text-blue-300');
            } else if (status === 'Selesai') {
                statusElement.classList.add('bg-green-100', 'text-green-800', 'dark:bg-green-900/50', 'dark:text-green-300');
            }

            openModal('view-modal');
        }

        // Close when clicking backdrop
        if (backdrop) {
            backdrop.addEventListener('click', () => {
                document.querySelectorAll('[role="dialog"]').forEach(el => {
                    el.classList.add('hidden');
                });
                backdrop.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });
        }

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

        // Tampilkan notifikasi jika ada parameter URL
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);

            if (urlParams.has('success')) {
                alert('Laporan berhasil ditambahkan!');
            } else if (urlParams.has('update')) {
                if (urlParams.get('update') === 'success') {
                    alert('Status laporan berhasil diperbarui!');
                } else if (urlParams.get('update') === 'failed') {
                    alert('Gagal memperbarui status laporan!');
                }
            } else if (urlParams.has('delete')) {
                if (urlParams.get('delete') === 'success') {
                    alert('Laporan berhasil dihapus!');
                }
            }

            // Hapus parameter dari URL
            if (urlParams.toString()) {
                window.history.replaceLocation({}, document.title, window.location.pathname);
            }
        });
    </script>

</body>

</html>