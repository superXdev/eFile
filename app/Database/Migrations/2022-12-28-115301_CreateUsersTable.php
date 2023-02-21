<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
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
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'level' => [
                'type'       => 'INTEGER'
            ],
            'id_fakultas' => [
                'type'       => 'INTEGER'
            ]
        ]);
        $this->forge->addKey('id', true, true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
