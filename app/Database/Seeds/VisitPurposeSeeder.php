<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VisitPurposeSeeder extends Seeder
{
    public function run()
    {
        $purposes = [
            'Konsultasi',
            'Pertemuan',
            'Pengantaran Dokumen',
            'Kunjungan Kerja',
            'Lainnya',
        ];

        foreach ($purposes as $name) {
            $exists = $this->db
                ->table('visit_purposes')
                ->where('name', $name)
                ->countAllResults();

            if ($exists === 0) {
                $this->db->table('visit_purposes')->insert([
                    'name'       => $name,
                    'is_active'  => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
