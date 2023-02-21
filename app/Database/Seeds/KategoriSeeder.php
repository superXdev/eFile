<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori' => 'Dokumen',
                'tanggal' => date('d-m-Y h:m:s A')
            ],
            [
                'nama_kategori' => 'Gambar',
                'tanggal' => date('d-m-Y h:m:s A')
            ],
            [
                'nama_kategori' => 'Arsip Negara',
                'tanggal' => date('d-m-Y h:m:s A')
            ]
        ];

        $this->db->table('kategori')->insertBatch($data);
    }
}
