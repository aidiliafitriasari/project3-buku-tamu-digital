<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WhatsappSettingsSeeder extends Seeder
{
    public function run()
    {
        $exists = $this->db
            ->table('whatsapp_settings')
            ->countAllResults();

        if ($exists === 0) {
            $this->db->table('whatsapp_settings')->insert([
                'is_enabled'       => false,
                'api_url'          => null,
                'api_key'          => null,
                'guest_enabled'   => true,
                'guest_template'  => null,
                'employee_enabled' => true,
                'employee_template' => null,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
