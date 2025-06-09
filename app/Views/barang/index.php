<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .form-section { border: 1px solid #ccc; border-radius: 5px; padding: 20px; margin-bottom: 20px; background: #fff; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; }
    .form-group input { width: 95%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
    .button-group button { padding: 10px 15px; border: none; border-radius: 4px; color: white; cursor: pointer; margin-right: 10px; }
    #btn-save { background-color: #007bff; }
</style>

<h1>Input Data Barang</h1>

<div class="form-section">
    <form id="form-barang">
        <div class="form-group"><label for="Kode_brg">Kode Barang</label><input type="text" id="Kode_brg" name="Kode_brg" required></div>
        <div class="form-group"><label for="Nama_brg">Nama Barang</label><input type="text" id="Nama_brg" name="Nama_brg" required></div>
        <div class="form-group"><label for="Satuan">Satuan</label><input type="text" id="Satuan" name="Satuan" required></div>
        <div class="form-group"><label for="Jml_stok">Jumlah Stok</label><input type="number" id="Jml_stok" name="Jml_stok" required></div>
    </form>
    <div class="button-group">
        <button id="btn-save">Save</button>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // Letakkan seluruh kode JavaScript untuk Save (AJAX) di sini
    // Salin dari file barang/index.php yang lama
    $(document).ready(function () {
         $('#btn-save').on('click', function() {
            var formData = $('#form-barang').serialize();
            $.ajax({
                url: "<?= base_url('/barang/save') ?>",
                type: "POST",
                data: formData,
                dataType: "JSON",
                success: function(response) {
                    alert(response.message);
                    if (response.status === 'success') {
                        $('#form-barang')[0].reset();
                    }
                },
                error: function() {
                    alert('Error: Terjadi kesalahan saat mengirim data.');
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>