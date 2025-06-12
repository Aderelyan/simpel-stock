<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    // Nama tabel di database sesuai tugas Person 1
    protected $table            = 'stok';
    
    // Primary Key dari tabel stok
    protected $primaryKey       = 'Kode_brg';
    
    // Kolom yang diizinkan untuk diisi/diubah.
    // Sesuaikan dengan semua kolom di tabel 'stok'
    protected $allowedFields    = ['Kode_brg', 'Nama_brg', 'Satuan', 'Jml_stok'];


    public function tambahBarang($data)
{
    // 1. Cek apakah Kode_brg sudah ada
    if ($this->find($data['Kode_brg'])) {
        return "Error: Kode barang sudah terpakai."; // Kembalikan pesan error spesifik
    }

    // 2. Jika tidak ada, panggil procedure INSERT
    $sql = "CALL tambah_barang(?, ?, ?, ?)";
    try {
        $this->db->query($sql, [$data['Kode_brg'], $data['Nama_brg'], $data['Satuan'], $data['Jml_stok']]);
        return true;
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

public function updateBarang($data)
{
    // 1. Cek apakah Kode_brg ada untuk di-update
    if (!$this->find($data['Kode_brg'])) {
        return "Error: Barang dengan kode ini tidak ditemukan."; // Kembalikan pesan error spesifik
    }

    // 2. Jika ada, panggil procedure UPDATE
    $sql = "CALL update_barang(?, ?, ?, ?)";
    try {
        $this->db->query($sql, [$data['Kode_brg'], $data['Nama_brg'], $data['Satuan'], $data['Jml_stok']]);
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
            $this->db->query("DELETE FROM stok");
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deletePembelian($kode_barang)
{
    // Cek dulu apakah data transaksinya ada
    if (!$this->find($kode_barang)) {
        return "Error: Data transaksi dengan kode ini tidak ditemukan.";
    }

    // Ganti 'sp_hapus_pembelian' dengan nama procedure Anda yang sebenarnya
    $sql = "CALL hapus_barang(?)";
    try {
        $this->db->query($sql, [$kode_barang]);
        return true;
    } catch (\Exception $e) {
        // Menangkap error jika ada masalah di database
        return "Gagal menghapus data: " . $e->getMessage();
    }
}
}

