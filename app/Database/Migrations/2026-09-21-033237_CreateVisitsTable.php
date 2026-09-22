<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVisitsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'guest_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'visit_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'qr_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
            ],
            'origin_institution' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'department_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'employee_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'visit_purpose_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'group_count' => [
                'type'     => 'SMALLINT',
                'unsigned' => true,
            ],
            'data_consent' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'arrival_at' => [
                'type' => 'DATETIME',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'menunggu',
                    'ditolak',
                    'dibatalkan',
                    'masih_berkunjung',
                    'selesai',
                ],
                'default' => 'menunggu',
            ],
            'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'signature' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'checkin_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'checkout_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'duration' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
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

        $this->forge->addUniqueKey('visit_code');
        $this->forge->addUniqueKey('qr_token');

        $this->forge->addKey('guest_id');
        $this->forge->addKey('department_id');
        $this->forge->addKey('employee_id');
        $this->forge->addKey('visit_purpose_id');
        $this->forge->addKey('arrival_at');
        $this->forge->addKey('status');
        $this->forge->addKey('deleted_at');

        $this->forge->addForeignKey(
            'guest_id',
            'guests',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'department_id',
            'departments',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'employee_id',
            'employees',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'visit_purpose_id',
            'visit_purposes',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->forge->createTable('visits');
    }

    public function down()
    {
        $this->forge->dropTable('visits', true);
    }
}
