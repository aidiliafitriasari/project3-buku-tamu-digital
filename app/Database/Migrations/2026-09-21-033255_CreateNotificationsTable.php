<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'visit_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'recipient_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'recipient_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'notification_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'sent', 'failed'],
                'default'    => 'pending',
            ],
            'sent_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('visit_id');
        $this->forge->addKey('recipient_type');
        $this->forge->addKey('recipient_phone');
        $this->forge->addKey('notification_type');
        $this->forge->addKey('status');
        $this->forge->addKey('created_at');

        $this->forge->addForeignKey(
            'visit_id',
            'visits',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->createTable('notifications');
    }

    public function down()
    {
        $this->forge->dropTable('notifications', true);
    }
}
