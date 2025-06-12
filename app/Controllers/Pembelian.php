<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembelianModel; // <-- Penting untuk memanggil Model

class Pembelian extends BaseController
{
    public function index()
    {
        return view('pembelian/index');
    }

    public function history()
    {
        return view('pembelian/history');
    }

    // FUNGSI YANG HILANG DITAMBAHKAN DI SINI
    public function listData()
    {
        $model = new PembelianModel();
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }

    // FUNGSI YANG HILANG DITAMBAHKAN DI SINI
    public function add()
{
    if ($this->request->isAJAX()) {
        $model = new PembelianModel();

        // Ambil tanggal mentah dari form
        $tanggalDariForm = $this->request->getPost('Tgl_trans');

        // Ubah format tanggalnya menggunakan fungsi PHP
        // Ini akan mengubah 'DD-MM-YYYY' atau 'MM/DD/YYYY' menjadi 'YYYY-MM-DD'
        $tanggalUntukDB = date('Y-m-d', strtotime($tanggalDariForm));

        // Siapkan data untuk dikirim ke model dengan tanggal yang sudah diformat ulang
        $data = [
            'Kd_trans'  => $this->request->getPost('Kd_trans'),
            'Tgl_trans' => $tanggalUntukDB, // <-- Gunakan tanggal yang sudah diformat
            'Kode_brg'  => $this->request->getPost('Kode_brg'),
            'Jml_beli'  => $this->request->getPost('Jml_beli'),
        ];

        $result = $model->tambahPembelian($data);

        if ($result === true) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data pembelian berhasil ditambahkan!']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => $result]);
        }
    }
}

public function update()
{
    if ($this->request->isAJAX()) {
        $model = new PembelianModel();
        $data = $this->request->getPost();
        $result = $model->updatePembelian($data);

        if ($result === true) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data Pembelian berhasil diperbarui!']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => $result]);
        }
    }
}

public function edit($Kd_trans)
{
    $model = new PembelianModel();
    // Gunakan fungsi find() bawaan CodeIgniter untuk mencari berdasarkan Primary Key
    $data = $model->find($Kd_trans);

    if ($data) {
        return $this->response->setJSON($data);
    } else {
        return $this->response->setStatusCode(404, 'Data tidak ditemukan');
    }

    }

public function delete($kd_trans)
{
    if ($this->request->isAJAX()) {
        $model = new PembelianModel();
        $result = $model->deletePembelian($kd_trans);

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
        $model = new PembelianModel();
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