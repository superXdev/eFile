<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArsipTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_arsip' => [
                'type' => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '150'
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'nomor' => [
                'type'       => 'VARCHAR',
                'constraint' => '20'
            ],
            'deskripsi' => [
                'type'       => 'TEXT'
            ],
            'ukuran' => [
                'type'       => 'INTEGER'
            ],
            'extensi' => [
                'type'       => 'VARCHAR',
                'constraint' => '10'
            ],
            'id_kategori' => [
                'type'       => 'INTEGER'
            ],
            'id_fakultas' => [
                'type'       => 'INTEGER'
            ],
            'id_user' => [
                'type'       => 'INTEGER'
            ],
            'tanggal_upload' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ]
        ]);
        $this->forge->addKey('id_arsip', true, true);
        $this->forge->createTable('arsip');
    }

    public function down()
    {
        $this->forge->dropTable('arsip');
    }
}
