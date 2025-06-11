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

<h1>Input Barang</h1>

<div class="form-section">
    <form id="form-barang">
        <div class="form-group"><label for="Kode_brg">Kode Barang</label><input type="text" id="Kode_brg" name="Kode_brg" required></div>
        <div class="form-group"><label for="Nama_brg">Nama Barang</label><input type="text" id="Nama_brg" name="Nama_brg" required></div>
        <div class="form-group"><label for="Satuan">Satuan</label><input type="text" id="Satuan" name="Satuan" required></div>
        <div class="form-group"><label for="Jml_stok">Jumlah Stok</label><input type="number" id="Jml_stok" name="Jml_stok" required></div>
    </form>
    <div class="button-group">
        <button id="btn-tambah">Tambah</button>
        <button id="btn-update">Update</button>
        <button id="btn-clear">Reset</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        // Fungsi untuk menampilkan notifikasi
        function showNotification(status, message) {
            Swal.fire({
                title: status === 'success' ? 'Berhasil!' : 'Gagal!',
                text: message,
                icon: status,
                timer: status === 'success' ? 2000 : 3000,
                showConfirmButton: status !== 'success'
            });
        }

        // Fungsi untuk membersihkan form
        function clearForm() {
            $('#Kode_brg').prop('readonly', false);
            $('#form-barang')[0].reset();
        }

        $('#btn-clear').on('click', function() {
            clearForm();
        });

        // Tombol TAMBAH
        $('#btn-tambah').on('click', function() {
            var formData = $('#form-barang').serialize();
            $.ajax({
                url: "<?= base_url('/barang/add') ?>",
                type: "POST", data: formData, dataType: "JSON",
                success: function(response) {
                    showNotification(response.status, response.message);
                    if (response.status === 'success') clearForm();
                },
                error: function() { showNotification('error', 'Terjadi kesalahan server.'); }
            });
        });

        // Tombol UPDATE
        $('#btn-update').on('click', function() {
            var formData = $('#form-barang').serialize();
            $.ajax({
                url: "<?= base_url('/barang/update') ?>",
                type: "POST", data: formData, dataType: "JSON",
                success: function(response) {
                    showNotification(response.status, response.message);
                    if (response.status === 'success') clearForm();
                },
                error: function() { showNotification('error', 'Terjadi kesalahan server.'); }
            });
        });

        // Logika untuk mengisi form saat mode edit (tetap sama)
        const editDataJSON = localStorage.getItem('editDataBarang');
        if(editDataJSON){
            const editData = JSON.parse(editDataJSON);
            $('#Kode_brg').val(editData.Kode_brg);
            $('#Nama_brg').val(editData.Nama_brg);
            $('#Satuan').val(editData.Satuan);
            $('#Jml_stok').val(editData.Jml_stok);
            $('#Kode_brg').prop('readonly', true);
            localStorage.removeItem('editDataBarang');
        }
    });
</script>
    
<?= $this->endSection() ?>