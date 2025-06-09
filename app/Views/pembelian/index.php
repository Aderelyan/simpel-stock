<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    /* Gaya ini bisa disatukan jika sama persis dengan halaman barang */
    .form-section { border: 1px solid #ccc; border-radius: 5px; padding: 20px; margin-bottom: 20px; background: #fff; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; }
    .form-group input { width: 95%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
    .button-group button { padding: 10px 15px; border: none; border-radius: 4px; color: white; cursor: pointer; margin-right: 10px; }
    #btn-save { background-color: #007bff; }
        #btn-insert { background-color: #28a745; }
        #btn-edit { background-color: #ffc107; }
        #btn-delete { background-color: #dc3545; }
        #btn-save { background-color: #007bff; }
        #btn-display { background-color: #17a2b8; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }

</style>

<h1>Form Pengelolaan Data Pembelian</h1>

<div class="form-section">
    <form id="form-pembelian">
        <div class="form-group"><label for="Kd_trans">Kode Transaksi</label><input type="text" id="Kd_trans" name="Kd_trans" required></div>
        <div class="form-group"><label for="Tgl_trans">Tanggal Transaksi</label><input type="date" id="Tgl_trans" name="Tgl_trans" required></div>
        <div class="form-group"><label for="Kode_brg">Kode Barang</label><input type="text" id="Kode_brg" name="Kode_brg" required></div>
        <div class="form-group"><label for="Jml_beli">Jumlah Beli</label><input type="number" id="Jml_beli" name="Jml_beli" required></div>
    </form>
    <div class="button-group">
         <button id="btn-insert">Insert</button><button id="btn-edit">Edit</button><button id="btn-delete">Delete</button><button id="btn-save">Save</button><button id="btn-display">Display</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // Script AJAX untuk halaman pembelian akan diletakkan di sini nanti
</script>

<?= $this->endSection() ?>
   
