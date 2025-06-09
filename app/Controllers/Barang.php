<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel; // Tambahkan ini

class Barang extends BaseController
{
    public function index()
    {
        return view('barang/index');
    }

    // TAMBAHKAN FUNGSI DI BAWAH INI
    public function listData()
    {
        // Buat instance dari model
        $model = new BarangModel();
        // Ambil semua data dari model
        $data = $model->findAll();

        // Kirim data sebagai JSON
        return $this->response->setJSON($data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $model = new BarangModel();
    
            $data = [
                'Kode_brg' => $this->request->getPost('Kode_brg'),
                'Nama_brg' => $this->request->getPost('Nama_brg'),
                'Satuan'   => $this->request->getPost('Satuan'),
                'Jml_stok' => $this->request->getPost('Jml_stok'),
            ];
    
            // Panggil method di model
            $result = $model->simpanDataBarang($data);
    
            // Periksa apakah hasilnya BENAR-BENAR true
            if ($result === true) {
                $response = [
                    'status'  => 'success',
                    'message' => 'Data barang berhasil disimpan!'
                ];
            } else {
                // Jika bukan true, berarti isinya adalah pesan error
                $response = [
                    'status'  => 'error',
                    'message' => 'Gagal menyimpan data: ' . $result // Tambahkan pesan error di sini
                ];
            }
    
            return $this->response->setJSON($response);
        }
    }
    public function history()
{
    return view('barang/history');
}
}

