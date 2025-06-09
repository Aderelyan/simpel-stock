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
    <div class="data-section-header">
        <h2>Data History Barang</h2>
        <button id="btn-display">Tampilkan/Refresh Data</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Jumlah Stok</th>
            </tr>
        </thead>
        <tbody id="data-tabel-barang">
            </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // Letakkan seluruh kode JavaScript untuk Display (AJAX) di sini
    // Salin dari file barang/index.php yang lama
    $(document).ready(function () {
        // Ketika tombol dengan id #btn-display di-klik
        $('#btn-display').on('click', function() {
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
                                '</tr>';
                    }
                    $('#data-tabel-barang').html(html);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error: Gagal memuat data!');
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>