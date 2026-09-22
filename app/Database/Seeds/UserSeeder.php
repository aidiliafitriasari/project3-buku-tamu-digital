<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'   => 'admin',
                'email'      => 'administrator123@gmail.com',
                'password'   => password_hash('Admin@123', PASSWORD_DEFAULT),
                'role'       => 'administrator',
                'nomor_hp'   => '081234567890',
                'is_active'  => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'petugas',
                'email'      => 'petugas123@gmail.com',
                'password'   => password_hash('Petugas@123', PASSWORD_DEFAULT),
                'role'       => 'petugas',
                'nomor_hp'   => '081234567891',
                'is_active'  => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $user) {
            $exists = $this->db
                ->table('users')
                ->where('username', $user['username'])
                ->orWhere('email', $user['email'])
                ->countAllResults();

            if ($exists === 0) {
                $this->db->table('users')->insert($user);
            }
        }
    }
}
