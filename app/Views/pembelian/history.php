<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .data-section { border: 1px solid #ccc; border-radius: 5px; padding: 20px; margin-bottom: 20px; background: #fff; }
    .data-section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .data-section-header button { padding: 10px 15px; border: none; border-radius: 4px; color: white; cursor: pointer; background-color: #17a2b8; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #f8f9fa; }
</style>
<div class="data-section">
    <h2>Data Pembelian</h2>
    <table>
        <thead><tr><th>Kode Transaksi</th><th>Tanggal Transaksi</th><th>Kode Barang</th><th>Jumlah Beli</th></tr></thead>
        <tbody id="data-tabel-pembelian"></tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // Script AJAX untuk halaman pembelian akan diletakkan di sini nanti
</script>

<?= $this->endSection() ?>