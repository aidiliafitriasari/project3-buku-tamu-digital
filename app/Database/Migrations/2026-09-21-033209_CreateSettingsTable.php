<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'primary_color' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'photo_required' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],
            'signature_required' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],
            'max_photo_size' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 500,
            ],
            'visit_warning' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('settings');
    }

    public function down()
    {
        $this->forge->dropTable('settings', true);
    }
}
