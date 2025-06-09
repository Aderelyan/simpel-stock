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


    public function simpanDataBarang($data)
    {
        // Ganti 'sp_simpan_barang' dengan nama Stored Procedure Anda
        $sql = "CALL tambah_barang(?, ?, ?, ?)";
    
        try {
            $this->db->query($sql, [
                $data['Kode_brg'],
                $data['Nama_brg'],
                $data['Satuan'],
                $data['Jml_stok']
            ]);
            return true; // Jika sukses, kembalikan true
        } catch (\Exception $e) {
            // Jika gagal, KEMBALIKAN PESAN ERROR-NYA
            return $e->getMessage();
        }
    }
}

