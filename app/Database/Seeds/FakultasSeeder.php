<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FakultasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_fakultas' => 'Teknik Informatika',
                'tanggal' => date('d-m-Y h:m:s A')
            ],
            [
                'nama_fakultas' => 'Sistem Informasi',
                'tanggal' => date('d-m-Y h:m:s A')
            ],
            [
                'nama_fakultas' => 'Sistem Komputer',
                'tanggal' => date('d-m-Y h:m:s A')
            ]
        ];

        $this->db->table('fakultas')->insertBatch($data);
    }
}
