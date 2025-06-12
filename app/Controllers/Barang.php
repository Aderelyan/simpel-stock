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

    public function add()
{
    if ($this->request->isAJAX()) {
        $model = new BarangModel();
        $data = $this->request->getPost();
        $result = $model->tambahBarang($data);

        if ($result === true) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data barang berhasil ditambahkan!']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => $result]);
        }
    }
}

public function update()
{
    if ($this->request->isAJAX()) {
        $model = new BarangModel();
        $data = $this->request->getPost();
        $result = $model->updateBarang($data);

        if ($result === true) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data barang berhasil diperbarui!']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => $result]);
        }
    }
}
    public function history()
{
    return view('barang/history');
}

public function edit($kode_brg)
{
    $model = new BarangModel();
    // Gunakan fungsi find() bawaan CodeIgniter untuk mencari berdasarkan Primary Key
    $data = $model->find($kode_brg);

    if ($data) {
        return $this->response->setJSON($data);
    } else {
        return $this->response->setStatusCode(404, 'Data tidak ditemukan');
    }

    }

    public function delete($kode_barang)
{
    if ($this->request->isAJAX()) {
        $model = new BarangModel();
        $result = $model->deletePembelian($kode_barang);

        if ($result === true) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data pembelian berhasil dihapus.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => $result]);
        }
    }
}

    public function reset()
{
    if ($this->request->isAJAX()) {
        $model = new BarangModel();
        $result = $model->resetData();

        if ($result === true) {
            $response = [
                'status'  => 'success',
                'message' => 'Seluruh data barang telah berhasil direset.'
            ];
        } else {
            // Jika hasilnya bukan true, berarti itu pesan error
            $response = [
                'status'  => 'error',
                'message' => 'Gagal mereset data: ' . $result
            ];
        }
        return $this->response->setJSON($response);
    }
}

}
