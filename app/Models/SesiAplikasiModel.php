<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;
use DateTimeZone;

class SesiAplikasiModel extends Model
{
    protected $table            = 'sesi_aplikasi';
    // Sesuaikan primary key jika berbeda
    protected $primaryKey       = 'id_sesi'; 
    protected $allowedFields    = ['user_id', 'username', 'status_login', 'waktu_login'];

    /**
     * Mencatat aktivitas login user.
     * Jika user sudah ada di tabel, update statusnya. Jika belum, buat baris baru.
     */
    protected $db;

    public function __construct()
    {
    // Panggil koneksi database default agar bisa digunakan
    parent::__construct();
    $this->db = \Config\Database::connect();
    }
    public function catatLogin($userId, $username)
    {
        // Cari apakah user sudah pernah tercatat
        $sesi = $this->where('user_id', $userId)->first();

        // Siapkan data yang akan di-update atau di-insert
        $data = [
            'user_id'       => $userId,
            'username'      => $username,
            'status_login'  => 'online',
            // Set waktu ke zona waktu Jakarta (WIB)
            'waktu_login'   => (new DateTime('now', new DateTimeZone('Asia/Jakarta')))->format('Y-m-d H:i:s')
        ];

        if ($sesi) {
            // Jika sudah ada, update record yang ada
            $this->where('user_id', $userId)->set($data)->update();
        } else {
            // Jika belum ada, insert record baru
            $this->insert($data);
        }
    }

    /**
     * Mencatat aktivitas logout user.
     */
    public function catatLogout($userId)
    {
        $this->where('user_id', $userId)->set(['status_login' => 'offline'])->update();
    }
}