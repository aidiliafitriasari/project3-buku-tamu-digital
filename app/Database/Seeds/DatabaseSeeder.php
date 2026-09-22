<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('DepartmentSeeder');
        $this->call('EmployeeSeeder');
        $this->call('VisitPurposeSeeder');
        $this->call('SettingsSeeder');
        $this->call('InstitutionProfileSeeder');
        $this->call('WhatsappSettingsSeeder');
    }
}
