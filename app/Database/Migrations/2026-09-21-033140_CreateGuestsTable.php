<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGuestsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'address' => [
                'type' => 'TEXT',
            ],
            'identity_type' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'ktp',
                    'sim',
                    'paspor',
                    'kartu_pelajar',
                    'kartu_mahasiswa',
                    'lainnya',
                ],
            ],
            'identity_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('phone');
        $this->forge->addKey('identity_number');
        $this->forge->addKey('deleted_at');

        $this->forge->createTable('guests');
    }

    public function down()
    {
        $this->forge->dropTable('guests', true);
    }
}
