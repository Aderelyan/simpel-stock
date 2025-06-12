<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .data-section { border: 1px solid #ccc; border-radius: 5px; padding: 20px; margin-bottom: 20px; background: #fff; }
    .data-section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .data-section-header button { padding: 10px 15px; border: none; border-radius: 4px; color: white; cursor: pointer; background-color: #17a2b8; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #f8f9fa; }
    #btn-reset-barang { background-color: #dc3545; margin-left:10px; }
    /* CSS untuk tombol aksi */
    .btn-aksi { padding: 5px 10px; border-radius: 4px; border: none; color: white; cursor: pointer; margin-right: 5px; }
    .btn-edit { background-color: #ffc107; }
    .btn-delete { background-color: #dc3545; }
</style>

<div class="data-section">
    <div class="data-section-header">
        <h2>Data History Barang</h2>
         <button id="btn-reset-barang">Reset Data</button> </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Jumlah Stok</th>
                <th>Aksi</th> </tr>
        </thead>
        <tbody id="data-tabel-barang">
            </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        function loadDataBarang() {
            $.ajax({
                url: "<?= base_url('/barang/list') ?>",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        html += '<tr>' +
                                    '<td>' + data[i].Kode_brg + '</td>' +
                                    '<td>' + data[i].Nama_brg + '</td>' +
                                    '<td>' + data[i].Satuan + '</td>' +
                                    '<td>' + data[i].Jml_stok + '</td>' +
                                    /* 2. TAMBAHKAN KOLOM AKSI DENGAN TOMBOL */
                                    '<td>' +
                                        '<button class="btn-aksi btn-edit" data-kode="' + data[i].Kode_brg + '">Edit</button>' +
                                        '<button class="btn-aksi btn-delete" data-kode="' + data[i].Kode_brg + '">Delete</button>' +
                                    '</td>' +
                                '</tr>';
                    }
                    $('#data-tabel-barang').html(html);
                },
                error: function() {
                    var errorRow = '<tr><td colspan="5" style="text-align:center; color:red;">Gagal memuat data. Coba lagi nanti.</td></tr>';
                    $('#data-tabel-barang').html(errorRow);
                }
            });
        }

        $('#btn-reset-barang').on('click', function() {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Semua data barang akan dihapus permanen. Aksi ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus Semua!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user konfirmasi, kirim request AJAX untuk mereset
                    $.ajax({
                        url: "<?= base_url('/barang/reset') ?>",
                        type: "POST",
                        dataType: "JSON",
                        success: function(response) {
    if (response.status === 'success') {
        Swal.fire('Dihapus!', response.message, 'success');
        loadDataBarang(); // Muat ulang tabel
    } else {
        // Jika status dari backend adalah 'error', tampilkan pesannya
        Swal.fire('Gagal!', response.message, 'error');
    }
},
                    });
                }
            })
        });

        loadDataBarang();
    });

    // Event handler untuk semua tombol .btn-edit di dalam tabel
$('#data-tabel-barang').on('click', '.btn-edit', function() {
    var kode_brg = $(this).data('kode'); // Ambil Kode_brg dari atribut data-kode

    // Ambil data spesifik dari server
    $.ajax({
        url: "<?= base_url('/barang/edit/') ?>" + kode_brg,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            // Simpan data ke localStorage
            localStorage.setItem('editDataBarang', JSON.stringify(data));

            // Arahkan pengguna ke halaman input form
            window.location.href = "<?= base_url('/barang') ?>";
        },
        error: function() {
    Swal.fire({
        title: 'Oops...',
        text: 'Gagal memuat data. Coba lagi nanti.',
        icon: 'error'
    });
    // Tampilkan pesan di tabel juga
    var errorRow = '<tr><td colspan="5" style="text-align:center; color:red;">Gagal memuat data.</td></tr>';
    $('#data-tabel-barang').html(errorRow);
}
    });
});

</script>

<?= $this->endSection() ?>