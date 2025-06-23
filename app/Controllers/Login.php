<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\SesiAplikasiModel; // <-- 1. Tambahkan use untuk model baru

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        // 1. Siapkan konfigurasi database dinamis berdasarkan input form
        $dynamicDbConfig = [
            'DSN'      => '',
            'hostname' => 'localhost',
            'username' => $username,
            'password' => $password,
            'database' => 'db_simpel_stock', // Pastikan nama database ini benar
            'DBDriver' => 'MySQLi',
            'DBDebug'  => false,
            'charset'  => 'utf8', // Matikan debug agar tidak crash jika koneksi gagal
        ];
    
        try {
            // 2. Coba buat koneksi dengan kredensial dari form
            $db = \Config\Database::connect($dynamicDbConfig);
            $db->connect(); // Perintah ini akan memicu error jika koneksi gagal
    
            // 3. Jika koneksi berhasil (tidak ada error), simpan kredensial ke session
            $ses_data = [
                'db_user'       => $username,
                'db_pass'       => $password, // SANGAT TIDAK AMAN, tapi diperlukan untuk arsitektur ini
                'username'      => $username, // Kita samakan saja untuk tampilan di UI
                'is_logged_in'  => TRUE
            ];
            $session->set($ses_data);
    
            return $this->response->setJSON(['status' => 'success', 'redirect_url' => base_url('/barang')]);
    
        } catch (\Exception $e) {
            // Tampilkan pesan error asli dari database untuk debugging
            return $this->response->setJSON([
                'status' => 'error', 
                'message' => 'Koneksi Gagal: ' . $e->getMessage()
            ]);
        }
    }

    public function logout()
    {
        $session = session();
        $sesiModel = new SesiAplikasiModel(); // <-- 4. Buat instance model baru

        // 5. Panggil fungsi untuk MENCATAT LOGOUT sebelum session dihancurkan
        if ($session->get('is_logged_in')) {
            $sesiModel->catatLogout($session->get('user_id'));
        }

        $session->destroy();

        return redirect()->to('/');
    }
}