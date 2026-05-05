<?php
require_once '../../auth/check_session.php';
check_login();

$pdo = require '../../config/connection.php';

// Ambil data statistik
$stats = [
    'total' => $pdo->query("SELECT COUNT(*) FROM laporan")->fetchColumn(),
    'pending' => $pdo->query("SELECT COUNT(*) FROM laporan WHERE status = 'Pending'")->fetchColumn(),
    'diproses' => $pdo->query("SELECT COUNT(*) FROM laporan WHERE status = 'Diproses'")->fetchColumn(),
    'selesai' => $pdo->query("SELECT COUNT(*) FROM laporan WHERE status = 'Selesai'")->fetchColumn(),
];

// Ambil data laporan terbaru
$stmt = $pdo->query("SELECT * FROM laporan ORDER BY tanggal DESC LIMIT 10");
$laporan = $stmt->fetchAll();

$page = 'dashboard';
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
        body { font-family: 'Inter', sans-serif; }
    </style>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-slate-50 text-slate-800 dark:bg-slate-900 dark:text-slate-200 transition-colors duration-300 antialiased overflow-hidden">

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
                            <button class="flex items-center max-w-xs bg-white dark:bg-slate-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-slate-900" id="user-menu-button">
                                <div class="h-8 w-8 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 font-bold">
                                    <?= substr($_SESSION['nama'] ?? 'A', 0, 1) ?>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
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
                                        <dd class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $stats['total'] ?></dd>
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
                                        <dd class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $stats['pending'] ?></dd>
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
                                        <dd class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $stats['diproses'] ?></dd>
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
                                        <dd class="text-2xl font-semibold text-slate-900 dark:text-white"><?= $stats['selesai'] ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports Table -->
                <div class="bg-white dark:bg-slate-800 shadow rounded-lg border border-slate-100 dark:border-slate-700/50 mb-8 transition-colors">
                    <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-700 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-white">Laporan Masuk</h3>
                        <div class="flex space-x-3 w-full sm:w-auto">
                            <?php if ($_SESSION['role'] === 'superadmin'): ?>
                            <button onclick="openModal('add-modal')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-blue-700 focus:outline-none transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Tambah Laporan
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                            <thead class="bg-slate-50 dark:bg-slate-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pelapor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">TKP</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-200 dark:divide-slate-700">
                                <?php foreach ($laporan as $row): ?>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 dark:text-white"><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-slate-900 dark:text-white"><?= htmlspecialchars($row['nama']) ?></div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400"><?= htmlspecialchars($row['nim'] ?? '-') ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400"><?= htmlspecialchars($row['tkp']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php
                                        $color = "bg-yellow-100 text-yellow-800";
                                        if ($row['status'] == "Diproses") $color = "bg-blue-100 text-blue-800";
                                        if ($row['status'] == "Selesai") $color = "bg-green-100 text-green-800";
                                        ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $color ?>"><?= $row['status'] ?></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <button onclick='openViewModal(<?= json_encode($row) ?>)' class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">Detail</button>
                                        <?php if ($_SESSION['role'] === 'superadmin'): ?>
                                        <button onclick='openEditModal(<?= $row['id'] ?>, "<?= $row['status'] ?>", <?= json_encode($row['catatan_admin']) ?>)' class="text-amber-600 hover:text-amber-900">Edit</button>
                                        <button onclick='openDeleteModal(<?= $row['id'] ?>)' class="text-red-600 hover:text-red-900">Hapus</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modals (Add, Edit, View, Delete) -->
    
    <div id="modal-backdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-50 hidden" aria-hidden="true"></div>

    <?php if ($_SESSION['role'] === 'superadmin'): ?>
    <!-- Edit Modal -->
    <div id="edit-modal" class="hidden fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200 dark:border-slate-700">
                <form action="update_report.php" method="POST">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-bold text-slate-900 dark:text-white mb-4">Tindak Lanjuti Laporan</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status Laporan</label>
                                <select name="status" id="edit-status" class="w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-slate-50 dark:bg-slate-700 dark:text-white py-2 px-3">
                                    <option value="Pending">Pending</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Catatan Admin / Tindak Lanjut</label>
                                <textarea name="catatan_admin" id="edit-catatan" rows="4" class="w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 bg-slate-50 dark:bg-slate-700 dark:text-white py-2 px-3" placeholder="Masukkan detail penanganan..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 focus:outline-none transition-colors sm:ml-3 sm:w-auto sm:text-sm">Simpan Perubahan</button>
                        <button type="button" onclick="closeModal('edit-modal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none transition-colors sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-modal" class="hidden fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200 dark:border-slate-700">
                <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <button type="button" id="confirm-delete-btn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none transition-colors sm:ml-3 sm:w-auto sm:text-sm">Hapus</button>
                    <button type="button" onclick="closeModal('delete-modal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none transition-colors sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- View Detail Modal -->
    <div id="view-modal" class="hidden fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full border border-slate-200 dark:border-slate-700">
                <div class="bg-white dark:bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-xl leading-6 font-bold text-slate-900 dark:text-white mb-4" id="modal-title">Detail Laporan</h3>
                    <div id="view-content" class="space-y-3 text-sm text-slate-600 dark:text-slate-300">
                        <!-- Filled by JS -->
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-slate-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-2 space-x-reverse">
                    <button type="button" onclick="closeModal('view-modal')" class="w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-slate-600 shadow-sm px-4 py-2 bg-white dark:bg-slate-800 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 sm:w-auto sm:text-sm">Tutup</button>
                    
                    <?php if ($_SESSION['role'] === 'superadmin'): ?>
                    <button type="button" id="btn-tindak-lanjuti" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 sm:w-auto sm:text-sm">Tindak Lanjuti</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        const backdrop = document.getElementById('modal-backdrop');

        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            backdrop.classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            backdrop.classList.add('hidden');
        }

        function openViewModal(data) {
            const content = document.getElementById('view-content');
            content.innerHTML = `
                <p><strong>Nama:</strong> ${data.nama}</p>
                <p><strong>Tanggal:</strong> ${data.tanggal}</p>
                <p><strong>TKP:</strong> ${data.tkp}</p>
                <p><strong>Status:</strong> ${data.status}</p>
                <div class="bg-slate-100 dark:bg-slate-700 p-3 rounded">
                    <strong>Kronologi:</strong><br>${data.kronologi}
                </div>
            `;
            
            const btnTindak = document.getElementById('btn-tindak-lanjuti');
            if (btnTindak) {
                btnTindak.onclick = () => {
                    closeModal('view-modal');
                    openEditModal(data.id, data.status, data.catatan_admin);
                };
            }
            
            openModal('view-modal');
        }

        function openEditModal(id, status, catatan) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-status').value = status;
            document.getElementById('edit-catatan').value = catatan || '';
            openModal('edit-modal');
        }

        function openDeleteModal(id) {
            document.getElementById('confirm-delete-btn').onclick = function() {
                window.location.href = 'delete_report.php?id=' + id;
            };
            openModal('delete-modal');
        }

        // Mobile Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Notification Logic
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                const action = urlParams.get('success');
                if (action === 'update') alert('Laporan berhasil diperbarui!');
                if (action === 'delete') alert('Laporan berhasil dihapus!');
                // Clean URL
                window.history.replaceState({}, document.title, window.location.pathname);
            } else if (urlParams.has('error')) {
                alert('Terjadi kesalahan sistem!');
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });
    </script>
</body>
</html>
