<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPEN-SARPRAS - Sistem Pengaduan & Inventaris Sekolah</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #475569;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
        }
        .dark .glass-card {
            background: rgba(30, 41, 59, 0.85);
            backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 min-h-screen flex flex-col transition-colors duration-200">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Navigation -->
        <aside id="sidebar" class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between z-30 transition-all duration-300 absolute md:relative -translate-x-full md:translate-x-0 h-full">
            <div>
                <!-- Logo & System Title -->
                <div class="p-5 flex items-center justify-between border-b border-slate-800">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-500/30">
                            <i class="fa-solid fa-school-flag"></i>
                        </div>
                        <div>
                            <h1 class="font-bold text-white text-base tracking-wide leading-tight">SIPEN-SARPRAS</h1>
                            <p class="text-xs text-slate-400">SMK Negeri 1 Nusantara</p>
                        </div>
                    </div>
                    <button id="closeSidebarMobile" class="md:hidden text-slate-400 hover:text-white">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1.5 text-sm font-medium">
                    <a href="#dashboard" onclick="switchTab('dashboard')" id="nav-dashboard" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-white bg-blue-600 shadow-md shadow-blue-600/30 transition-all">
                        <i class="fa-solid fa-chart-pie w-5 text-center"></i>
                        <span>Dashboard Utama</span>
                    </a>
                    <a href="#pengaduan" onclick="openModalPengaduan()" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-slate-400">
                        <i class="fa-solid fa-circle-plus w-5 text-center text-blue-400"></i>
                        <span>Buat Pengaduan</span>
                    </a>
                    <a href="#daftar-laporan" onclick="switchTab('daftar-laporan')" id="nav-daftar-laporan" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-slate-400">
                        <i class="fa-solid fa-list-check w-5 text-center"></i>
                        <span>Daftar Pengaduan</span>
                        <span id="badge-total-laporan" class="ml-auto bg-slate-800 text-blue-400 text-xs px-2 py-0.5 rounded-full font-semibold">128</span>
                    </a>
                    <a href="#inventaris" onclick="switchTab('inventaris')" id="nav-inventaris" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-slate-400">
                        <i class="fa-solid fa-boxes-stacked w-5 text-center"></i>
                        <span>Inventaris Sarpras</span>
                    </a>
                    <a href="#statistik" onclick="switchTab('statistik')" id="nav-statistik" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-slate-400">
                        <i class="fa-solid fa-chart-line w-5 text-center"></i>
                        <span>Laporan & Analitik</span>
                    </a>
                    <a href="#pengaturan" onclick="switchTab('pengaturan')" id="nav-pengaturan" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white transition-all text-slate-400">
                        <i class="fa-solid fa-sliders w-5 text-center"></i>
                        <span>Pengaturan</span>
                    </a>
                </nav>
            </div>

            <!-- Profile Widget Footer -->
            <div class="p-4 border-t border-slate-800">
                <div class="bg-slate-800/60 p-3 rounded-xl flex items-center justify-between">
                    <div class="flex items-center space-x-3 overflow-hidden">
                        <img id="userAvatar" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Avatar" class="w-9 h-9 rounded-full object-cover border-2 border-blue-500 flex-shrink-0">
                        <div class="truncate">
                            <h4 id="userName" class="text-xs font-semibold text-white truncate">Siti Rahma, S.Pd</h4>
                            <span id="userRole" class="text-[10px] text-blue-400 font-medium bg-blue-500/10 px-1.5 py-0.5 rounded border border-blue-500/20">Guru / Staff</span>
                        </div>
                    </div>
                    <!-- Role Switcher Button -->
                    <button onclick="toggleRoleMenu()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-slate-700">
                        <i class="fa-solid fa-right-left text-xs"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <!-- Topbar Header -->
            <header class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 h-16 flex items-center justify-between px-4 md:px-6 z-20 transition-colors">
                <div class="flex items-center space-x-3">
                    <button id="openSidebarMobile" class="md:hidden p-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <!-- Universal Search -->
                    <div class="relative hidden sm:block w-64 md:w-80">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        <input type="text" id="globalSearch" placeholder="Cari laporan, sarpras, lokasi..." class="w-full bg-slate-100 dark:bg-slate-900 border-0 rounded-xl pl-9 pr-4 py-2 text-sm text-slate-800 dark:text-slate-200 focus:ring-2 focus:ring-blue-500 focus:bg-white dark:focus:bg-slate-800 transition-all outline-none">
                    </div>
                </div>

                <!-- Right Action Controls -->
                <div class="flex items-center space-x-3">
                    <!-- Quick New Ticket Button -->
                    <button onclick="openModalPengaduan()" class="hidden sm:flex items-center space-x-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md shadow-blue-500/20 transition-all">
                        <i class="fa-solid fa-plus"></i>
                        <span>Pengaduan Baru</span>
                    </button>

                    <!-- Dark Mode Toggle -->
                    <button id="themeToggleBtn" onclick="toggleDarkMode()" class="p-2.5 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all">
                        <i class="fa-solid fa-moon dark:hidden"></i>
                        <i class="fa-solid fa-sun hidden dark:block text-amber-400"></i>
                    </button>

                    <!-- Notifications Dropdown -->
                    <div class="relative">
                        <button id="notifBtn" onclick="toggleNotifDropdown()" class="p-2.5 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl relative transition-all">
                            <i class="fa-regular fa-bell text-lg"></i>
                            <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-rose-500 rounded-full ring-2 ring-white dark:ring-slate-800"></span>
                        </button>
                        <!-- Notif Panel -->
                        <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 py-2 z-50">
                            <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
                                <h3 class="font-bold text-sm text-slate-800 dark:text-white">Notifikasi</h3>
                                <span class="text-xs text-blue-600 dark:text-blue-400 font-medium cursor-pointer">Tandai Dibaca</span>
                            </div>
                            <div class="max-h-64 overflow-y-auto divide-y divide-slate-100 dark:divide-slate-700/50">
                                <a href="#" class="block p-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                    <p class="text-xs text-slate-800 dark:text-slate-200 font-medium">Tiket #TK-1082 telah diselesaikan</p>
                                    <span class="text-[10px] text-slate-400">10 menit yang lalu</span>
                                </a>
                                <a href="#" class="block p-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                    <p class="text-xs text-slate-800 dark:text-slate-200 font-medium">Laporan baru: AC Lab Komputer Mati</p>
                                    <span class="text-[10px] text-slate-400">1 jam yang lalu</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 md:p-6 space-y-6">
                
                <!-- VIEW 1: DASHBOARD UTAMA -->
                <section id="view-dashboard" class="tab-view space-y-6">
                    
                    <!-- Welcome Banner -->
                    <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-blue-900 rounded-3xl p-6 text-white shadow-xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between">
                        <div class="z-10 max-w-xl space-y-2">
                            <span class="bg-blue-500/20 text-blue-300 text-xs px-3 py-1 rounded-full font-semibold border border-blue-400/30">Layanan Fasilitas Sekolah</span>
                            <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight">Selamat Datang di SIPEN-SARPRAS</h2>
                            <p class="text-slate-300 text-sm leading-relaxed">Laporkan kerusakan fasilitas sekolah dengan cepat, pantau perbaikan secara real-time, dan dukung kenyamanan belajar mengajar.</p>
                        </div>
                        <div class="mt-4 md:mt-0 z-10">
                            <button onclick="openModalPengaduan()" class="bg-white text-slate-900 hover:bg-blue-50 font-bold px-5 py-3 rounded-2xl text-sm shadow-lg hover:shadow-xl transition-all flex items-center space-x-2">
                                <i class="fa-solid fa-paper-plane text-blue-600"></i>
                                <span>Buat Laporan Sekarang</span>
                            </button>
                        </div>
                        <!-- Decorative background shapes -->
                        <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
                        <div class="absolute right-40 top-0 w-40 h-40 bg-indigo-500/10 rounded-full blur-2xl pointer-events-none"></div>
                    </div>

                    <!-- Overview Stat Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Card 1 -->
                        <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                            <div class="space-y-1">
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Laporan</p>
                                <h3 id="statTotal" class="text-2xl font-bold text-slate-800 dark:text-white">128</h3>
                                <span class="text-emerald-500 text-xs font-semibold flex items-center"><i class="fa-solid fa-arrow-up mr-1"></i> +12% bulan ini</span>
                            </div>
                            <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center text-xl">
                                <i class="fa-solid fa-clipboard-list"></i>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                            <div class="space-y-1">
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Sedang Diproses</p>
                                <h3 id="statProses" class="text-2xl font-bold text-slate-800 dark:text-white">14</h3>
                                <span class="text-amber-500 text-xs font-semibold flex items-center"><i class="fa-solid fa-clock mr-1"></i> Penanganan aktif</span>
                            </div>
                            <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-2xl flex items-center justify-center text-xl">
                                <i class="fa-solid fa-gears"></i>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                            <div class="space-y-1">
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Laporan Selesai</p>
                                <h3 id="statSelesai" class="text-2xl font-bold text-slate-800 dark:text-white">102</h3>
                                <span class="text-emerald-500 text-xs font-semibold flex items-center"><i class="fa-solid fa-check mr-1"></i> 80% terselesaikan</span>
                            </div>
                            <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center text-xl">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                            <div class="space-y-1">
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Sarpras Perlu Perbaikan</p>
                                <h3 id="statRusak" class="text-2xl font-bold text-slate-800 dark:text-white">12</h3>
                                <span class="text-rose-500 text-xs font-semibold flex items-center"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Perlu perhatian</span>
                            </div>
                            <div class="w-12 h-12 bg-rose-50 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 rounded-2xl flex items-center justify-center text-xl">
                                <i class="fa-solid fa-wrench"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Visualizations Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Chart Line: Tren Pengaduan -->
                        <div class="lg:col-span-2 bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="font-bold text-slate-800 dark:text-white text-base">Tren Pengaduan Sarpras</h3>
                                    <p class="text-xs text-slate-400">Statistik jumlah pengaduan masuk tahun 2026</p>
                                </div>
                                <select class="bg-slate-100 dark:bg-slate-700 border-0 rounded-lg text-xs px-3 py-1.5 font-medium text-slate-600 dark:text-slate-300 outline-none">
                                    <option>Tahun 2026</option>
                                    <option>Tahun 2025</option>
                                </select>
                            </div>
                            <div class="h-64 relative">
                                <canvas id="trendChart"></canvas>
                            </div>
                        </div>

                        <!-- Chart Doughnut: Kategori Breakdown -->
                        <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-slate-800 dark:text-white text-base mb-1">Kategori Fasilitas</h3>
                                <p class="text-xs text-slate-400 mb-4">Persentase pengaduan per bidang</p>
                                <div class="h-52 relative">
                                    <canvas id="categoryChart"></canvas>
                                </div>
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-700 flex justify-around text-center text-xs">
                                <div>
                                    <span class="block font-bold text-slate-800 dark:text-white">42%</span>
                                    <span class="text-slate-400">Elektronik</span>
                                </div>
                                <div>
                                    <span class="block font-bold text-slate-800 dark:text-white">28%</span>
                                    <span class="text-slate-400">Mebel/Furnitur</span>
                                </div>
                                <div>
                                    <span class="block font-bold text-slate-800 dark:text-white">30%</span>
                                    <span class="text-slate-400">Lainnya</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Reports Data Table -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
                        <div class="p-5 border-b border-slate-100 dark:border-slate-700 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                            <div>
                                <h3 class="font-bold text-slate-800 dark:text-white text-base">Pengaduan Terbaru</h3>
                                <p class="text-xs text-slate-400">Daftar laporan kerusakan fasilitas sekolah yang baru masuk</p>
                            </div>
                            <!-- Filters & Actions -->
                            <div class="flex items-center space-x-2">
                                <select id="tableFilterStatus" onchange="filterTable()" class="bg-slate-100 dark:bg-slate-700 border-0 rounded-xl text-xs px-3 py-2 font-medium text-slate-600 dark:text-slate-300 outline-none">
                                    <option value="Semua">Semua Status</option>
                                    <option value="Menunggu">Menunggu</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                                <button onclick="switchTab('daftar-laporan')" class="text-xs text-blue-600 dark:text-blue-400 hover:underline font-semibold px-2 py-1">Lihat Semua</button>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
                                <thead class="bg-slate-50 dark:bg-slate-900/50 text-xs uppercase font-semibold text-slate-400 border-b border-slate-100 dark:border-slate-700">
                                    <tr>
                                        <th class="py-3.5 px-4">ID Tiket</th>
                                        <th class="py-3.5 px-4">Pelapor</th>
                                        <th class="py-3.5 px-4">Kategori & Lokasi</th>
                                        <th class="py-3.5 px-4">Tanggal</th>
                                        <th class="py-3.5 px-4">Urgensi</th>
                                        <th class="py-3.5 px-4">Status</th>
                                        <th class="py-3.5 px-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="recentTableBody" class="divide-y divide-slate-100 dark:divide-slate-700/50">
                                    <!-- Dynamic Rows Rendered by JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>

                <!-- VIEW 2: DAFTAR PENGADUAN (FULL TABLE) -->
                <section id="view-daftar-laporan" class="tab-view space-y-6 hidden">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Daftar Pengaduan Sarpras</h2>
                            <p class="text-xs text-slate-400">Kelola dan update status tiket pengaduan fasilitas</p>
                        </div>
                        <button onclick="openModalPengaduan()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md shadow-blue-500/20">
                            <i class="fa-solid fa-plus mr-1"></i> Tambah Pengaduan
                        </button>
                    </div>

                    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm p-4 space-y-4">
                        <!-- Search & Filter Controls -->
                        <div class="flex flex-col sm:flex-row gap-3 justify-between">
                            <div class="relative flex-1">
                                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="text" id="fullSearchInput" onkeyup="filterFullTable()" placeholder="Cari berdasarkan pelapor, tiket, atau lokasi..." class="w-full bg-slate-100 dark:bg-slate-900 border-0 rounded-xl pl-9 pr-4 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex gap-2">
                                <select id="fullFilterStatus" onchange="filterFullTable()" class="bg-slate-100 dark:bg-slate-900 border-0 rounded-xl text-sm px-3 py-2 font-medium text-slate-600 dark:text-slate-300 outline-none">
                                    <option value="Semua">Semua Status</option>
                                    <option value="Menunggu">Menunggu</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>

                        <!-- Full Data Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
                                <thead class="bg-slate-50 dark:bg-slate-900/50 text-xs uppercase font-semibold text-slate-400 border-b border-slate-100 dark:border-slate-700">
                                    <tr>
                                        <th class="py-3.5 px-4">ID Tiket</th>
                                        <th class="py-3.5 px-4">Pelapor</th>
                                        <th class="py-3.5 px-4">Kategori & Lokasi</th>
                                        <th class="py-3.5 px-4">Tanggal</th>
                                        <th class="py-3.5 px-4">Urgensi</th>
                                        <th class="py-3.5 px-4">Status</th>
                                        <th class="py-3.5 px-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="fullTableBody" class="divide-y divide-slate-100 dark:divide-slate-700/50">
                                    <!-- Dynamic Content -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- VIEW 3: INVENTARIS SARPRAS KATALOG -->
                <section id="view-inventaris" class="tab-view space-y-6 hidden">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Katalog & Status Inventaris Sarpras</h2>
                            <p class="text-xs text-slate-400">Monitoring kondisi aset dan fasilitas di lingkungan sekolah</p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 px-3 py-2 rounded-xl text-xs font-semibold">
                                <i class="fa-solid fa-download mr-1"></i> Export Data
                            </button>
                        </div>
                    </div>

                    <!-- Inventory Grid Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5" id="inventoryGrid">
                        <!-- Rendered dynamically -->
                    </div>
                </section>

                <!-- VIEW 4: ANALITIK & STATISTIK -->
                <section id="view-statistik" class="tab-view space-y-6 hidden">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Laporan & Analitik Sarpras</h2>
                        <p class="text-xs text-slate-400">Ringkasan performa pemeliharaan dan waktu tanggap perbaikan</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm space-y-4">
                            <h3 class="font-bold text-slate-800 dark:text-white">Respon Rata-rata</h3>
                            <div class="text-center py-6">
                                <span class="text-5xl font-black text-blue-600 dark:text-blue-400">2.4</span>
                                <span class="text-slate-400 text-sm block mt-1">Jam Waktu Tanggap</span>
                            </div>
                            <p class="text-xs text-slate-400 text-center">Peningkatan efisiensi sebesar 18% dibandingkan bulan sebelumnya.</p>
                        </div>

                        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm space-y-4 lg:col-span-2">
                            <h3 class="font-bold text-slate-800 dark:text-white">Tingkat Kepuasan Pelapor</h3>
                            <div class="flex items-center space-x-4">
                                <div class="text-4xl font-extrabold text-emerald-500">94.8%</div>
                                <div class="text-xs text-slate-400">Berdasarkan 85 ulasan dari guru dan siswa setelah laporan selesai ditangani.</div>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-700 h-3 rounded-full overflow-hidden flex">
                                <div class="bg-emerald-500 h-full" style="width: 85%"></div>
                                <div class="bg-blue-500 h-full" style="width: 10%"></div>
                                <div class="bg-amber-500 h-full" style="width: 5%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-slate-400">
                                <span><i class="fa-solid fa-circle text-emerald-500 text-[10px] mr-1"></i> Sangat Puas (85%)</span>
                                <span><i class="fa-solid fa-circle text-blue-500 text-[10px] mr-1"></i> Puas (10%)</span>
                                <span><i class="fa-solid fa-circle text-amber-500 text-[10px] mr-1"></i> Cukup (5%)</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- VIEW 5: PENGATURAN -->
                <section id="view-pengaturan" class="tab-view space-y-6 hidden">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Pengaturan Sistem</h2>
                        <p class="text-xs text-slate-400">Konfigurasi akun dan sistem pengaduan</p>
                    </div>

                    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm p-6 max-w-2xl space-y-6">
                        <div class="space-y-4">
                            <h3 class="font-bold text-slate-800 dark:text-white text-sm border-b border-slate-100 dark:border-slate-700 pb-2">Notifikasi System</h3>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-slate-800 dark:text-slate-200">Notifikasi Email</p>
                                    <p class="text-xs text-slate-400">Kirim update tiket via email</p>
                                </div>
                                <input type="checkbox" checked class="w-5 h-5 accent-blue-600 rounded">
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-slate-800 dark:text-slate-200">Notifikasi WhatsApp Admin</p>
                                    <p class="text-xs text-slate-400">Kirim pemberitahuan darurat ke WA Tim Sarpras</p>
                                </div>
                                <input type="checkbox" checked class="w-5 h-5 accent-blue-600 rounded">
                            </div>
                        </div>
                    </div>
                </section>

            </main>
        </div>
    </div>

    <!-- MODAL 1: FORM BUAT PENGADUAN BARU -->
    <div id="modalPengaduan" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden transition-opacity duration-200">
        <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 dark:border-slate-700 transform transition-all scale-100 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center border-b border-slate-100 dark:border-slate-700 pb-4">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-bullhorn text-sm"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 dark:text-white text-lg">Buat Pengaduan Baru</h3>
                </div>
                <button onclick="closeModalPengaduan()" class="text-slate-400 hover:text-slate-600 dark:hover:text-white">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <form id="formPengaduan" onsubmit="handlePengaduanSubmit(event)" class="space-y-4 mt-4">
                <!-- Kategori Sarpras -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Kategori Fasilitas / Sarpras</label>
                    <select id="formKategori" required class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-800 dark:text-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Elektronik & AC">Elektronik & AC / Kipas</option>
                        <option value="Mebel & Meja Kursi">Mebel & Meja Kursi Kelas</option>
                        <option value="Toilet & Air">Toilet & Fasilitas Air</option>
                        <option value="Proyektor & Lab">Proyektor & Komputer Lab</option>
                        <option value="Bangunan & Pintu">Fisik Bangunan / Pintu / Jendela</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>

                <!-- Lokasi / Ruangan -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Lokasi Ruangan / Area</label>
                    <input type="text" id="formLokasi" placeholder="Misal: Lab Komputer 2, Kelas XII IPA 1, Toilet Lt 2" required class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-800 dark:text-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Judul Deskripsi -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Judul Ringkas Pengaduan</label>
                    <input type="text" id="formJudul" placeholder="Singkat & Jelas, misal: AC Rusak Tidak Dingin" required class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-800 dark:text-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Deskripsi Detail Masalah</label>
                    <textarea id="formDeskripsi" rows="3" placeholder="Jelaskan kronologi atau kondisi detail kerusakan..." required class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-800 dark:text-slate-200 focus:ring-2 focus:ring-blue-500 outline-none resize-none"></textarea>
                </div>

                <!-- Tingkat Urgensi -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Tingkat Urgensi</label>
                    <div class="grid grid-cols-4 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="urgensi" value="Rendah" class="peer hidden" checked>
                            <div class="text-center py-2 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-semibold peer-checked:bg-slate-100 dark:peer-checked:bg-slate-700 peer-checked:border-slate-400 dark:peer-checked:text-white transition-all">Rendah</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="urgensi" value="Sedang" class="peer hidden">
                            <div class="text-center py-2 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-semibold peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/40 peer-checked:border-blue-500 peer-checked:text-blue-600 dark:peer-checked:text-blue-400 transition-all">Sedang</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="urgensi" value="Tinggi" class="peer hidden">
                            <div class="text-center py-2 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-semibold peer-checked:bg-amber-50 dark:peer-checked:bg-amber-900/40 peer-checked:border-amber-500 peer-checked:text-amber-600 dark:peer-checked:text-amber-400 transition-all">Tinggi</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="urgensi" value="Darurat" class="peer hidden">
                            <div class="text-center py-2 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-semibold peer-checked:bg-rose-50 dark:peer-checked:bg-rose-900/40 peer-checked:border-rose-500 peer-checked:text-rose-600 dark:peer-checked:text-rose-400 transition-all">Darurat</div>
                        </label>
                    </div>
                </div>

                <!-- File Drag & Drop Upload Placeholder -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Upload Foto Kerusakan</label>
                    <div id="dropZone" class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl p-4 text-center cursor-pointer hover:border-blue-500 dark:hover:border-blue-400 transition-colors">
                        <i class="fa-solid fa-cloud-arrow-up text-2xl text-slate-400 mb-1"></i>
                        <p class="text-xs text-slate-600 dark:text-slate-300 font-medium">Klik atau seret foto ke sini</p>
                        <p class="text-[10px] text-slate-400">PNG, JPG max 5MB</p>
                        <input type="file" id="fileInput" accept="image/*" class="hidden" onchange="previewImage(event)">
                        <div id="imagePreview" class="hidden mt-2">
                            <img src="" id="imgPreviewTag" class="h-20 mx-auto rounded-lg object-cover border">
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="pt-2 flex justify-end space-x-3">
                    <button type="button" onclick="closeModalPengaduan()" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">Batal</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-xs font-semibold shadow-lg shadow-blue-500/20">Kirim Laporan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 2: DETAIL TIKET & UPDATE STATUS -->
    <div id="modalDetail" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 dark:border-slate-700 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center border-b border-slate-100 dark:border-slate-700 pb-3">
                <div>
                    <span id="detailTiketId" class="text-xs font-mono font-bold text-blue-600 dark:text-blue-400">#TK-1001</span>
                    <h3 id="detailJudul" class="font-bold text-slate-800 dark:text-white text-base">Detail Laporan</h3>
                </div>
                <button onclick="closeModalDetail()" class="text-slate-400 hover:text-slate-600 dark:hover:text-white">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <div class="space-y-4 mt-4 text-xs">
                <div class="bg-slate-50 dark:bg-slate-900 p-3 rounded-xl space-y-2">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Pelapor:</span>
                        <span id="detailPelapor" class="font-semibold text-slate-800 dark:text-white">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Kategori & Lokasi:</span>
                        <span id="detailLokasi" class="font-semibold text-slate-800 dark:text-white">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Tanggal Lapor:</span>
                        <span id="detailTanggal" class="font-semibold text-slate-800 dark:text-white">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Urgensi:</span>
                        <span id="detailUrgensi" class="font-semibold">-</span>
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi Kerusakan:</h4>
                    <p id="detailDeskripsi" class="text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-slate-900/50 p-3 rounded-xl leading-relaxed">
                        -
                    </p>
                </div>

                <!-- Admin Action Change Status -->
                <div class="border-t border-slate-100 dark:border-slate-700 pt-3">
                    <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Update Status Laporan (Petugas/Admin):</label>
                    <div class="flex space-x-2">
                        <select id="updateStatusSelect" class="flex-1 bg-slate-100 dark:bg-slate-900 border-0 rounded-xl px-3 py-2 text-xs font-semibold text-slate-800 dark:text-slate-200 outline-none">
                            <option value="Menunggu">Menunggu</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                        <button onclick="saveStatusUpdate()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl font-semibold shadow">Simpan Status</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Alert Container -->
    <div id="toastContainer" class="fixed bottom-5 right-5 z-50 flex flex-col space-y-2 pointer-events-none"></div>

    <!-- JavaScript Dynamic Interactivity Script -->
    <script>
        // Default Mock Data
        let reportsData = [
            { id: "TK-2026-001", pelapor: "Ahmad Rizky (Siswa)", kategori: "Elektronik & AC", lokasi: "Lab Komputer 1", judul: "AC Mati dan Berisik", deskripsi: "AC nomor 2 di lab komputer mengeluarkan bunyi bising dan pendingin tidak berfungsi sama sekali.", tanggal: "22 Sep 2026", urgensi: "Tinggi", status: "Diproses" },
            { id: "TK-2026-002", pelapor: "Budi Santoso, S.Pd (Guru)", kategori: "Proyektor & Lab", lokasi: "Ruang Kelas XII IPA 2", judul: "Proyektor Blurr / Buram", deskripsi: "Lensa proyektor berdebu berat di dalam dan tampilan presentasi buram tidak terbaca.", tanggal: "21 Sep 2026", urgensi: "Sedang", status: "Menunggu" },
            { id: "TK-2026-003", pelapor: "Dewi Lestari (Siswa)", kategori: "Toilet & Air", lokasi: "Toilet Putri Lt 1", judul: "Kran Air Bocor", deskripsi: "Kran air terus mengalir keras tidak bisa ditutup rapat, membuang air.", tanggal: "20 Sep 2026", urgensi: "Darurat", status: "Selesai" },
            { id: "TK-2026-004", pelapor: "Eko Prasetyo (Siswa)", kategori: "Mebel & Meja Kursi", lokasi: "Kelas X IPS 3", judul: "Kursi Patah", deskripsi: "Dua sandaran kursi kayu patah, membahayakan jika diduduki.", tanggal: "19 Sep 2026", urgensi: "Rendah", status: "Selesai" },
            { id: "TK-2026-005", pelapor: "Siti Nurhaliza (Siswa)", kategori: "Bangunan & Pintu", lokasi: "Perpustakaan", judul: "Pintu Kaca Macet", deskripsi: "Engsel pintu kaca perpustakaan berdecit keras dan tersangkut saat dibuka.", tanggal: "18 Sep 2026", urgensi: "Sedang", status: "Ditolak" }
        ];

        let inventoryData = [
            { nama: "AC Split 2 PK (Daikin)", lokasi: "Lab Komputer 1", kondisi: "Rusak Ringan", badge: "bg-amber-500/10 text-amber-600 border-amber-500/20", icon: "fa-snowflake" },
            { nama: "Proyektor Epson EB-E500", lokasi: "Ruang Kelas XII IPA 2", kondisi: "Kondisi Baik", badge: "bg-emerald-500/10 text-emerald-600 border-emerald-500/20", icon: "fa-video" },
            { nama: "Set Meja Kursi Kayu", lokasi: "Kelas X IPS 3", kondisi: "Rusak Berat", badge: "bg-rose-500/10 text-rose-600 border-rose-500/20", icon: "fa-chair" },
            { nama: "Pompa Air Utama", lokasi: "Gedung Utama", kondisi: "Sedang Diperbaiki", badge: "bg-blue-500/10 text-blue-600 border-blue-500/20", icon: "fa-faucet-drip" },
            { nama: "Komputer PC Client (PC-04)", lokasi: "Lab Bahasa", kondisi: "Kondisi Baik", badge: "bg-emerald-500/10 text-emerald-600 border-emerald-500/20", icon: "fa-desktop" },
            { nama: "Papan Tulis Whiteboard", lokasi: "Kelas XI TITL", kondisi: "Kondisi Baik", badge: "bg-emerald-500/10 text-emerald-600 border-emerald-500/20", icon: "fa-chalkboard" }
        ];

        let selectedActiveTicketId = null;

        window.onload = function() {
            renderTables();
            renderInventoryGrid();
            initCharts();
            updateStatsCounters();

            // Mobile Sidebar Handlers
            document.getElementById('openSidebarMobile').addEventListener('click', () => {
                document.getElementById('sidebar').classList.remove('-translate-x-full');
            });
            document.getElementById('closeSidebarMobile').addEventListener('click', () => {
                document.getElementById('sidebar').classList.add('-translate-x-full');
            });

            // Drag and Drop Zone file upload trigger
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('fileInput');
            dropZone.addEventListener('click', () => fileInput.click());
        };

        function switchTab(tabId) {
            // Hide all views
            document.querySelectorAll('.tab-view').forEach(view => view.classList.add('hidden'));
            
            // Show target view
            const targetView = document.getElementById('view-' + tabId);
            if(targetView) targetView.classList.remove('hidden');

            // Update Active Nav Link CSS
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('bg-blue-600', 'text-white', 'shadow-md', 'shadow-blue-600/30');
                item.classList.add('text-slate-400');
            });

            const activeNav = document.getElementById('nav-' + tabId);
            if(activeNav) {
                activeNav.classList.add('bg-blue-600', 'text-white', 'shadow-md', 'shadow-blue-600/30');
                activeNav.classList.remove('text-slate-400');
            }

            // Close mobile sidebar on navigation
            document.getElementById('sidebar').classList.add('-translate-x-full');
        }

        function renderTables() {
            const recentBody = document.getElementById('recentTableBody');
            const fullBody = document.getElementById('fullTableBody');
            
            recentBody.innerHTML = '';
            fullBody.innerHTML = '';

            reportsData.forEach((item, index) => {
                const rowHtml = `
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                        <td class="py-3 px-4 font-mono text-xs font-bold text-blue-600 dark:text-blue-400">${item.id}</td>
                        <td class="py-3 px-4 font-medium text-slate-800 dark:text-slate-200">${item.pelapor}</td>
                        <td class="py-3 px-4">
                            <span class="block font-semibold text-slate-700 dark:text-slate-300 text-xs">${item.kategori}</span>
                            <span class="text-[11px] text-slate-400"><i class="fa-solid fa-location-dot mr-1"></i>${item.lokasi}</span>
                        </td>
                        <td class="py-3 px-4 text-xs text-slate-500">${item.tanggal}</td>
                        <td class="py-3 px-4">${getUrgensiBadge(item.urgensi)}</td>
                        <td class="py-3 px-4">${getStatusBadge(item.status)}</td>
                        <td class="py-3 px-4 text-center">
                            <button onclick="openModalDetail('${item.id}')" class="text-xs bg-slate-100 dark:bg-slate-700 hover:bg-blue-50 dark:hover:bg-blue-900/40 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 px-3 py-1.5 rounded-lg transition-all font-medium">
                                Detail / Edit
                            </button>
                        </td>
                    </tr>
                `;

                fullBody.innerHTML += rowHtml;
                if(index < 5) {
                    recentBody.innerHTML += rowHtml;
                }
            });
        }

        function getStatusBadge(status) {
            switch(status) {
                case 'Menunggu':
                    return `<span class="bg-amber-500/10 text-amber-600 border border-amber-500/20 px-2.5 py-1 rounded-full text-[11px] font-semibold"><i class="fa-solid fa-clock mr-1"></i>Menunggu</span>`;
                case 'Diproses':
                    return `<span class="bg-blue-500/10 text-blue-600 border border-blue-500/20 px-2.5 py-1 rounded-full text-[11px] font-semibold"><i class="fa-solid fa-spinner fa-spin mr-1"></i>Diproses</span>`;
                case 'Selesai':
                    return `<span class="bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 px-2.5 py-1 rounded-full text-[11px] font-semibold"><i class="fa-solid fa-check mr-1"></i>Selesai</span>`;
                case 'Ditolak':
                    return `<span class="bg-rose-500/10 text-rose-600 border border-rose-500/20 px-2.5 py-1 rounded-full text-[11px] font-semibold"><i class="fa-solid fa-xmark mr-1"></i>Ditolak</span>`;
                default:
                    return status;
            }
        }

        function getUrgensiBadge(urgensi) {
            switch(urgensi) {
                case 'Darurat':
                    return `<span class="text-rose-600 font-bold text-xs"><i class="fa-solid fa-circle text-[8px] mr-1"></i>Darurat</span>`;
                case 'Tinggi':
                    return `<span class="text-amber-600 font-semibold text-xs"><i class="fa-solid fa-circle text-[8px] mr-1"></i>Tinggi</span>`;
                case 'Sedang':
                    return `<span class="text-blue-600 font-medium text-xs"><i class="fa-solid fa-circle text-[8px] mr-1"></i>Sedang</span>`;
                default:
                    return `<span class="text-slate-500 text-xs"><i class="fa-solid fa-circle text-[8px] mr-1"></i>Rendah</span>`;
            }
        }

        function renderInventoryGrid() {
            const grid = document.getElementById('inventoryGrid');
            grid.innerHTML = '';

            inventoryData.forEach(item => {
                grid.innerHTML += `
                    <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow space-y-3">
                        <div class="flex justify-between items-start">
                            <div class="w-10 h-10 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl flex items-center justify-center text-lg">
                                <i class="fa-solid ${item.icon}"></i>
                            </div>
                            <span class="${item.badge} border px-2.5 py-0.5 rounded-full text-[10px] font-bold">${item.kondisi}</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 dark:text-white text-sm">${item.nama}</h4>
                            <p class="text-xs text-slate-400 mt-0.5"><i class="fa-solid fa-location-dot mr-1"></i>${item.lokasi}</p>
                        </div>
                    </div>
                `;
            });
        }

        function openModalPengaduan() {
            document.getElementById('modalPengaduan').classList.remove('hidden');
        }

        function closeModalPengaduan() {
            document.getElementById('modalPengaduan').classList.add('hidden');
            document.getElementById('formPengaduan').reset();
            document.getElementById('imagePreview').classList.add('hidden');
        }

        function previewImage(event) {
            const file = event.target.files[0];
            if(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imgPreviewTag').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function handlePengaduanSubmit(e) {
            e.preventDefault();
            
            const kategori = document.getElementById('formKategori').value;
            const lokasi = document.getElementById('formLokasi').value;
            const judul = document.getElementById('formJudul').value;
            const deskripsi = document.getElementById('formDeskripsi').value;
            const urgensi = document.querySelector('input[name="urgensi"]:checked').value;
            const pelapor = document.getElementById('userName').innerText + " (User)";

            const newId = "TK-2026-00" + (reportsData.length + 1);
            const today = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });

            const newTicket = {
                id: newId,
                pelapor: pelapor,
                kategori: kategori,
                lokasi: lokasi,
                judul: judul,
                deskripsi: deskripsi,
                tanggal: today,
                urgensi: urgensi,
                status: "Menunggu"
            };

            reportsData.unshift(newTicket);
            renderTables();
            updateStatsCounters();
            closeModalPengaduan();
            showToast("Berhasil!", "Laporan pengaduan Anda telah terkirim dan akan ditinjau tim Sarpras.", "success");
        }

        function openModalDetail(id) {
            const ticket = reportsData.find(t => t.id === id);
            if(!ticket) return;

            selectedActiveTicketId = id;
            document.getElementById('detailTiketId').innerText = "#" + ticket.id;
            document.getElementById('detailJudul').innerText = ticket.judul;
            document.getElementById('detailPelapor').innerText = ticket.pelapor;
            document.getElementById('detailLokasi').innerText = `${ticket.kategori} (${ticket.lokasi})`;
            document.getElementById('detailTanggal').innerText = ticket.tanggal;
            document.getElementById('detailUrgensi').innerHTML = getUrgensiBadge(ticket.urgensi);
            document.getElementById('detailDeskripsi').innerText = ticket.deskripsi;
            document.getElementById('updateStatusSelect').value = ticket.status;

            document.getElementById('modalDetail').classList.remove('hidden');
        }

        function closeModalDetail() {
            document.getElementById('modalDetail').classList.add('hidden');
            selectedActiveTicketId = null;
        }

        function saveStatusUpdate() {
            if(!selectedActiveTicketId) return;
            const newStatus = document.getElementById('updateStatusSelect').value;
            const ticket = reportsData.find(t => t.id === selectedActiveTicketId);
            if(ticket) {
                ticket.status = newStatus;
                renderTables();
                updateStatsCounters();
                closeModalDetail();
                showToast("Status Diperbarui", `Status tiket #${selectedActiveTicketId} diubah menjadi ${newStatus}.`, "info");
            }
        }

        function filterTable() {
            const filterValue = document.getElementById('tableFilterStatus').value;
            const rows = document.querySelectorAll('#recentTableBody tr');
            
            reportsData.forEach((item, index) => {
                if(index < 5 && rows[index]) {
                    if(filterValue === 'Semua' || item.status === filterValue) {
                        rows[index].style.display = '';
                    } else {
                        rows[index].style.display = 'none';
                    }
                }
            });
        }

        function filterFullTable() {
            const searchVal = document.getElementById('fullSearchInput').value.toLowerCase();
            const statusVal = document.getElementById('fullFilterStatus').value;
            const rows = document.querySelectorAll('#fullTableBody tr');

            reportsData.forEach((item, index) => {
                if(rows[index]) {
                    const matchSearch = item.pelapor.toLowerCase().includes(searchVal) || 
                                        item.id.toLowerCase().includes(searchVal) || 
                                        item.lokasi.toLowerCase().includes(searchVal) ||
                                        item.judul.toLowerCase().includes(searchVal);
                    const matchStatus = (statusVal === 'Semua') || (item.status === statusVal);

                    if(matchSearch && matchStatus) {
                        rows[index].style.display = '';
                    } else {
                        rows[index].style.display = 'none';
                    }
                }
            });
        }

        function updateStatsCounters() {
            const total = reportsData.length;
            const proses = reportsData.filter(r => r.status === 'Diproses').length;
            const selesai = reportsData.filter(r => r.status === 'Selesai').length;
            
            document.getElementById('statTotal').innerText = total;
            document.getElementById('statProses').innerText = proses;
            document.getElementById('statSelesai').innerText = selesai;
            document.getElementById('badge-total-laporan').innerText = total;
        }

        function initCharts() {
            // Line Chart: Tren Laporan Per Bulan
            const ctxTrend = document.getElementById('trendChart').getContext('2d');
            new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'],
                    datasets: [{
                        label: 'Pengaduan Masuk',
                        data: [12, 19, 15, 22, 18, 25, 14, 20, 28],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#2563eb'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { grid: { borderDash: [4, 4] }, ticks: { precision: 0 } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Doughnut Chart: Kategori Breakdown
            const ctxCat = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctxCat, {
                type: 'doughnut',
                data: {
                    labels: ['Elektronik & AC', 'Mebel & Meja Kursi', 'Toilet & Air', 'Proyektor/Lab', 'Lainnya'],
                    datasets: [{
                        data: [42, 28, 15, 10, 5],
                        backgroundColor: ['#3b82f6', '#f59e0b', '#10b981', '#6366f1', '#94a3b8'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } } },
                    cutout: '70%'
                }
            });
        }

        function toggleDarkMode() {
            const html = document.documentElement;
            if(html.classList.contains('dark')) {
                html.classList.remove('dark');
            } else {
                html.classList.add('dark');
            }
        }

        function toggleNotifDropdown() {
            const dropdown = document.getElementById('notifDropdown');
            dropdown.classList.toggle('hidden');
        }

        function toggleRoleMenu() {
            const currentRole = document.getElementById('userRole').innerText;
            if(currentRole.includes('Guru')) {
                document.getElementById('userName').innerText = "Rizky Ramadhan";
                document.getElementById('userRole').innerText = "Siswa (XII IPA 1)";
                document.getElementById('userAvatar').src = "https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=100&auto=format&fit=crop&q=80";
                showToast("Ganti Akses Role", "Berpindah ke profil Siswa", "info");
            } else {
                document.getElementById('userName').innerText = "Siti Rahma, S.Pd";
                document.getElementById('userRole').innerText = "Guru / Staff";
                document.getElementById('userAvatar').src = "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80";
                showToast("Ganti Akses Role", "Berpindah ke profil Guru / Staff", "info");
            }
        }

        function showToast(title, message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            
            let bgBg = 'bg-slate-900 text-white';
            let icon = 'fa-circle-check text-emerald-400';

            if(type === 'info') icon = 'fa-circle-info text-blue-400';

            toast.className = `${bgBg} p-4 rounded-2xl shadow-xl flex items-center space-x-3 pointer-events-auto transform transition-all duration-300 translate-y-2 opacity-0 max-w-md border border-slate-800`;
            toast.innerHTML = `
                <i class="fa-solid ${icon} text-lg"></i>
                <div>
                    <h5 class="text-xs font-bold">${title}</h5>
                    <p class="text-[11px] text-slate-300">${message}</p>
                </div>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('translate-y-2', 'opacity-0');
            }, 10);

            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
    </script>
</body>
</html>