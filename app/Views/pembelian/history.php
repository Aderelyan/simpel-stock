<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .data-section { border: 1px solid #ccc; border-radius: 5px; padding: 20px; margin-bottom: 20px; background: #fff; }
    .data-section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .data-section-header button { padding: 10px 15px; border: none; border-radius: 4px; color: white; cursor: pointer; background-color: #17a2b8; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #f8f9fa; }
    #btn-reset-pembelian { background-color: #dc3545; margin-left:10px; }
    /* CSS untuk tombol aksi */
    .btn-aksi { padding: 5px 10px; border-radius: 4px; border: none; color: white; cursor: pointer; margin-right: 5px; }
    .btn-edit { background-color: #ffc107; }
    .btn-delete { background-color: #dc3545; }
</style>
<div class="data-section">
    
    <div class="data-section-header"><h2>Data Pembelian</h2>
    <button id="btn-reset-pembelian">Reset Data</button> </div>
    </div>
    <table>
        <thead><tr><th>Kode Transaksi</th><th>Tanggal Transaksi</th><th>Kode Barang</th><th>Jumlah Beli</th><th>Aksi</th></tr></thead>
        <tbody id="data-tabel-pembelian"></tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        function loadDataPembelian() {
            $.ajax({
                url: "<?= base_url('/pembelian/list') ?>",
                type: "GET", dataType: "JSON",
                success: function(data) {
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        html += '<tr>' +
                                    '<td>' + data[i].Kd_trans + '</td>' +
                                    '<td>' + data[i].Tgl_trans + '</td>' +
                                    '<td>' + data[i].Kode_brg + '</td>' +
                                    '<td>' + data[i].Jml_beli + '</td>' +
                                    '<td>' +
                                        // Pastikan tombol memiliki atribut data-kode yang benar
                                        '<button class="btn-aksi btn-edit" data-kode="' + data[i].Kd_trans + '">Edit</button> ' +
                                        '<button class="btn-aksi btn-delete" data-kode="' + data[i].Kd_trans + '">Delete</button>' +
                                    '</td>' +
                                '</tr>';
                    }
                    $('#data-tabel-pembelian').html(html);
                },
                error: function() { /* ... */ }
            });
        }

        $('#btn-display-pembelian').on('click', function() {
            loadDataPembelian();
        });

        // Event handler untuk tombol .btn-delete
        $('#data-tabel-pembelian').on('click', '.btn-delete', function() {
            var kd_trans = $(this).data('kode'); // Ambil kode dari tombol

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data transaksi " + kd_trans + " akan dihapus. Stok barang akan dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('/pembelian/delete/') ?>" + kd_trans,
                        type: "POST",
                        dataType: "JSON",
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire('Dihapus!', response.message, 'success');
                                loadDataPembelian(); // Muat ulang data tabel
                            } else {
                                Swal.fire('Gagal!', response.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Oops...', 'Terjadi kesalahan server.', 'error');
                        }
                    });
                }
            });
        });

          // Event handler untuk tombol Reset baru
          $('#btn-reset-pembelian').on('click', function() {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Semua data pembelian akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus Semua!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('/pembelian/reset') ?>",
                        type: "POST",
                        dataType: "JSON",
                        success: function(response) {
                            Swal.fire('Dihapus!', response.message, 'success');
                            loadDataPembelian(); // Muat ulang tabel
                        },
                        error: function(jqXHR) {
                            Swal.fire('Gagal!', 'Terjadi kesalahan: ' + jqXHR.responseText, 'error');
                        }
                    });
                }
            })
        });

        loadDataPembelian();
        $('#data-tabel-pembelian').on('click', '.btn-edit', function() {
    var kd_trans = $(this).data('kode'); 

    $.ajax({
        url: "<?= base_url('/pembelian/edit/') ?>" + kd_trans,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            // Simpan data ke localStorage untuk dibawa ke halaman form
            localStorage.setItem('editDataPembelian', JSON.stringify(data));

            // Arahkan pengguna ke halaman input form
            window.location.href = "<?= base_url('/pembelian') ?>";
        },
        error: function() {
            Swal.fire('Gagal!', 'Gagal mengambil data untuk diedit.', 'error');
        }
    });
});
    });
</script>

<?= $this->endSection() ?>