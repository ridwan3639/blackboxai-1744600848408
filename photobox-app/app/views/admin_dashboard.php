<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Photobox</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white p-4">
            <div class="flex items-center space-x-2 mb-8">
                <i class="fas fa-camera-retro text-2xl"></i>
                <h1 class="text-xl font-bold">Photobox Admin</h1>
            </div>
            
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center space-x-2 p-2 rounded hover:bg-blue-700" onclick="showSection('dashboard')">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-2 p-2 rounded hover:bg-blue-700" onclick="showSection('backgrounds')">
                            <i class="fas fa-image"></i>
                            <span>Background</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-2 p-2 rounded hover:bg-blue-700" onclick="showSection('frames')">
                            <i class="fas fa-square"></i>
                            <span>Frame</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-2 p-2 rounded hover:bg-blue-700" onclick="showSection('layouts')">
                            <i class="fas fa-th-large"></i>
                            <span>Layout</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-2 p-2 rounded hover:bg-blue-700" onclick="showSection('vouchers')">
                            <i class="fas fa-ticket-alt"></i>
                            <span>Voucher</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-2 p-2 rounded hover:bg-blue-700" onclick="showSection('transactions')">
                            <i class="fas fa-receipt"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-2 p-2 rounded hover:bg-blue-700" onclick="showSection('settings')">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 overflow-auto">
            <!-- Dashboard Section -->
            <div id="dashboard-section" class="section-content">
                <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-2">Total Transaksi</h3>
                        <p class="text-3xl font-bold text-blue-600">1,248</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-2">Pendapatan Hari Ini</h3>
                        <p class="text-3xl font-bold text-green-600">Rp 3,120,000</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-2">Foto Diambil</h3>
                        <p class="text-3xl font-bold text-purple-600">7,488</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow mb-8">
                    <h3 class="text-lg font-semibold mb-4">Statistik Transaksi 7 Hari Terakhir</h3>
                    <div class="h-64">
                        <!-- Chart would be implemented with Chart.js in actual application -->
                        <div class="flex items-center justify-center h-full bg-gray-100 rounded">
                            <p class="text-gray-500">Grafik statistik transaksi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Backgrounds Section -->
            <div id="backgrounds-section" class="section-content hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Kelola Background</h2>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        <i class="fas fa-plus mr-2"></i>Tambah Background
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <!-- Background items would be dynamically loaded -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img src="images/backgrounds/bg1.jpg" alt="Background 1" class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="font-semibold">Background 1</h3>
                            <div class="flex justify-between mt-2">
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox" checked>
                                    <span class="ml-2">Aktif</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- More background items would be here -->
                </div>
            </div>

            <!-- Other sections (frames, layouts, vouchers, transactions, settings) would follow similar structure -->
            <!-- Content for these sections would be loaded dynamically in actual implementation -->
        </div>
    </div>

    <script>
        // Show selected section and hide others
        function showSection(sectionId) {
            document.querySelectorAll('.section-content').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(`${sectionId}-section`).classList.remove('hidden');
        }

        // Initialize with dashboard section visible
        showSection('dashboard');
    </script>
</body>
</html>
