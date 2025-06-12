<?php
namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model 
{
    // Nama tabel di database sesuai tugas Person 1
    protected $table            = 't_beli';
    
    // Primary Key dari tabel stok
    protected $primaryKey       = 'Kd_trans';
    
    // Kolom yang diizinkan untuk diisi/diubah.
    // Sesuaikan dengan semua kolom di tabel 'stok'
    protected $allowedFields    = ['Kd_trans', 'Tgl_trans', 'kode_brg', 'Jml_beli'];

   

public function tambahPembelian($data)
{
    // 1. Cek apakah Kd_trans sudah ada
    if ($this->find($data['Kd_trans'])) {
        return "Error: Kode transaksi sudah terpakai.";
    }

    // 2. Panggil procedure untuk menyimpan pembelian
    // Ganti 'sp_simpan_pembelian' dengan nama procedure Anda yang sebenarnya
    $sql = "CALL tambah_pembelian(?, ?, ?, ?)";
    try {
        $this->db->query($sql, [
            $data['Kd_trans'],
            $data['Tgl_trans'],
            $data['Kode_brg'],
            $data['Jml_beli']
        ]);
        return true;
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

public function resetData()
    {
        try {
            // Kita gunakan perintah SQL mentah untuk melewati fitur keamanan CI4.
            // Perintah ini secara eksplisit mengatakan "hapus semua dari tabel stok".
            $this->db->query("DELETE FROM t_beli");
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

public function updatePembelian($data)
{
    // 1. Cek apakah pembelian ada untuk di-update
    if (!$this->find($data['Kd_trans'])) {
        return "Error: Barang dengan kode ini tidak ditemukan."; // Kembalikan pesan error spesifik
    }

    // 2. Jika ada, panggil procedure UPDATE
    $sql = "CALL update_pembelian(?, ?, ?, ?)";
    try {
        $this->db->query($sql, [$data['Kd_trans'], $data['Tgl_trans'], $data['Kode_brg'], $data['Jml_beli']]);
        return true;
    } catch (\Exception $e) {
        return $e->getMessage();
    }
    }

public function deletePembelian($kd_trans)
{
    // Cek dulu apakah data transaksinya ada
    if (!$this->find($kd_trans)) {
        return "Error: Data transaksi dengan kode ini tidak ditemukan.";
    }

    // Ganti 'sp_hapus_pembelian' dengan nama procedure Anda yang sebenarnya
    $sql = "CALL hapus_pembelian(?)";
    try {
        $this->db->query($sql, [$kd_trans]);
        return true;
    } catch (\Exception $e) {
        // Menangkap error jika ada masalah di database
        return "Gagal menghapus data: " . $e->getMessage();
    }
}

}