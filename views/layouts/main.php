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

    <body class="bg-slate-50 text-slate-800 dark:bg-slate-900 dark:text-slate-200 transition-colors duration-300 antialiased ">

    <!-- Navbar (Simplified) -->
     <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <?php include '../partials/sidebar.php'; ?>
            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Navbar -->

                <!-- Content Area -->
                 <!-- PAGE CONTENT (INI YANG DINAMIS) -->
            <div class="flex-grow p-6 overflow-auto">
                <?= $content ?>
            </div>
    </div>
    <script src=public/js/dashboard.js></script>
    </body>

    </html>