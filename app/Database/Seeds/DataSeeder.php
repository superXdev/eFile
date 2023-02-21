<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        $this->call('KategoriSeeder');
        $this->call('FakultasSeeder');
        $this->call('UserSeeder');
    }
}
