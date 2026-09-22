<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $departments = $this->db
            ->table('departments')
            ->get()
            ->getResultArray();

        $departmentMap = [];

        foreach ($departments as $department) {
            $departmentMap[$department['name']] = $department['id'];
        }

        $employees = [
            [
                'department' => 'Administrasi',
                'name'       => 'Andi Pratama',
                'nomor_hp'   => '081234560001',
                'email'      => 'andipratama123@gmail.com',
            ],
            [
                'department' => 'Pelayanan',
                'name'       => 'Siti Rahma',
                'nomor_hp'   => '081234560002',
                'email'      => 'sitirahma123@gmail.com',
            ],
            [
                'department' => 'Keuangan',
                'name'       => 'Budi Santoso',
                'nomor_hp'   => '081234560003',
                'email'      => 'budisantoso123@gmail.com',
            ],
            [
                'department' => 'Umum',
                'name'       => 'Dewi Lestari',
                'nomor_hp'   => '081234560004',
                'email'      => 'dewilestari123@gmail.com',
            ],
        ];

        foreach ($employees as $employee) {
            if (!isset($departmentMap[$employee['department']])) {
                continue;
            }

            $exists = $this->db
                ->table('employees')
                ->where('email', $employee['email'])
                ->countAllResults();

            if ($exists === 0) {
                $this->db->table('employees')->insert([
                    'department_id' => $departmentMap[$employee['department']],
                    'name'          => $employee['name'],
                    'nomor_hp'      => $employee['nomor_hp'],
                    'email'         => $employee['email'],
                    'is_active'     => true,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
