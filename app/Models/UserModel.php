<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // Ganti 'users' dengan nama tabel pengguna Anda
    protected $table            = 'users';
    protected $primaryKey       = 'id'; // Ganti dengan primary key tabel pengguna Anda
    protected $allowedFields    = ['username', 'password'];

    public function verifyUser($username, $password)
    {
        // Cari user berdasarkan username
        $user = $this->where('username', $username)->first();

        // Jika user tidak ditemukan, langsung kembalikan false
        if (!$user) {
            return false;
        }

        // Jika user ditemukan, periksa passwordnya
        // password_verify() akan membandingkan password dari form dengan hash di database
        if (password_verify($password, $user['password'])) {
            // Jika password cocok, kembalikan data user
            return $user;
        } else {
            // Jika password tidak cocok, kembalikan false
            return false;
        }
    }
}