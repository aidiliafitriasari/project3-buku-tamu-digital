<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $exists = $this->db
            ->table('settings')
            ->countAllResults();

        if ($exists === 0) {
            $this->db->table('settings')->insert([
                'primary_color'      => '#00309F',
                'photo_required'     => true,
                'signature_required' => true,
                'max_photo_size'     => 500,
                'visit_warning'      => 60,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
