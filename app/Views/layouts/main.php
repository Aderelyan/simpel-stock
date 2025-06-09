<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Manajemen Stok</title>
    <style>
        /* Reset CSS */
        body, h1, h2, ul, li, a { margin: 0; padding: 0; font-family: Arial, sans-serif; box-sizing: border-box; }
        a { text-decoration: none; color: inherit; }

        /* Main Layout Styling */
        .app-container { display: flex; height: 100vh; }
        .sidebar { width: 240px; background-color: #2c3e50; color: white; padding: 20px; }
        .main-content { flex-grow: 1; overflow-y: auto; }

        /* Header Styling */
        .header { background-color: #ffffff; padding: 15px 30px; border-bottom: 1px solid #ecf0f1; display: flex; justify-content: space-between; align-items: center; }
        .app-name { font-size: 24px; font-weight: bold; color: #2c3e50; }
        .user-info { font-size: 16px; }

        /* Sidebar Styling */
        .sidebar h2 { text-align: center; margin-bottom: 30px; }
        .sidebar-nav ul { list-style: none; }
        .sidebar-nav li a { display: block; padding: 15px 20px; border-radius: 5px; margin-bottom: 10px; transition: background-color 0.3s; }
        .sidebar-nav li a:hover, .sidebar-nav li a.active { background-color: #34495e; }

        /* Content Area Styling */
        .content-area { padding: 30px; }
    </style>
</head>
<body>
    <div class="app-container">
        <aside class="sidebar">
            <h2>Navigasi</h2>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="<?= base_url('/barang') ?>">Barang</a></li>
                    <li><a href="<?= base_url('/pembelian') ?>">Pembelian</a></li>
                    <li><a href="<?= base_url('/barang/history') ?>">History Barang</a></li>
                    <li><a href="<?= base_url('/pembelian/history') ?>">History Pembelian</a></li>
                </ul>
            </nav>
        </aside>

        <div class="main-content">
            <header class="header">
                <div class="app-name">
                    Stok App
                </div>
                <div class="user-info">
                    Login sebagai: <strong>Admin</strong> </div>
            </header>

            <main class="content-area">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>
</body>
</html>