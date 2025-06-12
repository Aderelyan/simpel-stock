<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .form-section { border: 1px solid #ccc; border-radius: 5px; padding: 20px; margin-bottom: 20px; background: #fff; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; }
    .form-group input { width: 95%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
    .button-group button { padding: 10px 15px; border: none; border-radius: 4px; color: white; cursor: pointer; margin-right: 10px; }
    #btn-tambah { background-color: #28a745; }
    #btn-update { background-color: #007bff; }
    #btn-clear { background-color: #6c757d; }
</style>

<h1>Input & Update Data Pembelian</h1>

<div class="form-section">
    <form id="form-pembelian">
        <div class="form-group"><label for="Kd_trans">Kode Transaksi</label><input type="text" id="Kd_trans" name="Kd_trans" required></div>
        <div class="form-group"><label for="Tgl_trans">Tanggal Transaksi</label><input type="date" id="Tgl_trans" name="Tgl_trans" required></div>
        <div class="form-group"><label for="Kode_brg">Kode Barang</label><input type="text" id="Kode_brg" name="Kode_brg" required></div>
        <div class="form-group"><label for="Jml_beli">Jumlah Beli</label><input type="number" id="Jml_beli" name="Jml_beli" required></div>
    </form>
    <div class="button-group">
        <button id="btn-tambah">Tambah</button>
        <button id="btn-update">Update</button>
        <button id="btn-clear">Batal / Input Baru</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        function showNotification(status, message) {
            Swal.fire({ title: status === 'success' ? 'Berhasil!' : 'Gagal!', text: message, icon: status });
        }

        function clearForm() {
            $('#Kd_trans').prop('readonly', false);
            $('#form-pembelian')[0].reset();
        }

        $('#btn-clear').on('click', clearForm);

        // Cek localStorage saat halaman dimuat
        const editDataJSON = localStorage.getItem('editDataPembelian');
        if(editDataJSON){
            const editData = JSON.parse(editDataJSON);
            $('#Kd_trans').val(editData.Kd_trans);
            $('#Tgl_trans').val(editData.Tgl_trans);
            $('#Kode_brg').val(editData.Kode_brg);
            $('#Jml_beli').val(editData.Jml_beli);
            $('#Kd_trans').prop('readonly', true);
            localStorage.removeItem('editDataPembelian');
        }

        // Handler untuk tombol TAMBAH
        $('#btn-tambah').on('click', function(e) {
            e.preventDefault();
            var formData = $('#form-pembelian').serialize();
            $.ajax({
                url: "<?= base_url('/pembelian/add') ?>", type: "POST", data: formData, dataType: "JSON",
                success: function(response) {
                    showNotification(response.status, response.message);
                    if (response.status === 'success') clearForm();
                },
                error: function() { showNotification('error', 'Terjadi kesalahan server.'); }
            });
        });

        // Handler untuk tombol UPDATE
        $('#btn-update').on('click', function(e) {
            e.preventDefault();
            var formData = $('#form-pembelian').serialize();
            $.ajax({
                url: "<?= base_url('/pembelian/update') ?>", type: "POST", data: formData, dataType: "JSON",
                success: function(response) {
                    showNotification(response.status, response.message);
                    if (response.status === 'success') clearForm();
                },
                error: function() { showNotification('error', 'Terjadi kesalahan server.'); }
            });
        });
    });
</script>

<?= $this->endSection() ?>