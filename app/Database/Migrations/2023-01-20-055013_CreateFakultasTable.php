<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFakultasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_fakultas' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'tanggal' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ]
        ]);
        $this->forge->addKey('id', true, true);
        $this->forge->createTable('fakultas');
    }

    public function down()
    {
        $this->forge->dropTable('fakultas');
    }
}
