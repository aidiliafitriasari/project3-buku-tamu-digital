<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            'Administrasi',
            'Pelayanan',
            'Keuangan',
            'Umum',
        ];

        foreach ($departments as $name) {
            $exists = $this->db
                ->table('departments')
                ->where('name', $name)
                ->countAllResults();

            if ($exists === 0) {
                $this->db->table('departments')->insert([
                    'name'       => $name,
                    'is_active'  => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
