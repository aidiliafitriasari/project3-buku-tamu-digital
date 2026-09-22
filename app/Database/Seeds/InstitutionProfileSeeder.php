<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InstitutionProfileSeeder extends Seeder
{
    public function run()
    {
        $exists = $this->db
            ->table('institution_profiles')
            ->countAllResults();

        if ($exists === 0) {
            $this->db->table('institution_profiles')->insert([
                'name'       => 'Kantor Amins Project Teknologi Indonesia',
                'logo'       => null,
                'address'    => 'Jl. Cempedak VI No.I, Taman, Kec. Taman, Kota Madiun, Jawa Timur 63131',
                'phone'      => '081234567899',
                'email'      => 'info@aminsproject.test',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
