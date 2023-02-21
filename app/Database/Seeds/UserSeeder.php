<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'level' => 1,
                'id_fakultas' => 1
            ],
            [
                'nama' => 'David',
                'username' => 'david',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'level' => 1,
                'id_fakultas' => 2
            ],
            [
                'nama' => 'User',
                'username' => 'user',
                'password' => password_hash('user', PASSWORD_DEFAULT),
                'level' => 2,
                'id_fakultas' => 3
            ]
        ];

        $this->db->table('user')->insertBatch($data);
    }
}
