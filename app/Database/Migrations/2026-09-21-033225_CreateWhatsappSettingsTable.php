<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWhatsappSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'is_enabled' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'api_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
            'api_key' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
            'guest_enabled' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],
            'guest_template' => [
                'type'    => 'TEXT',
                'null'    => true,
                'default' => null,
            ],
            'employee_enabled' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],
            'employee_template' => [
                'type'    => 'TEXT',
                'null'    => true,
                'default' => null,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('whatsapp_settings');
    }

    public function down()
    {
        $this->forge->dropTable('whatsapp_settings', true);
    }
}
