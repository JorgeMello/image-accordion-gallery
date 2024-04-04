<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Imagem extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('imagens');
    }

    public function down()
    {
        $this->forge->dropTable('imagens');
    }
}
