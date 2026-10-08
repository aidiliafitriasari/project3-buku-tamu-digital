<?php

namespace App\Validation;

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\VisitPurposeModel;

class CustomRules
{
    public function is_active_department(string $value): bool
    {
        if (! is_numeric($value)) {
            return false;
        }

        $model = new DepartmentModel();

        $department = $model
            ->where('id', (int) $value)
            ->where('is_active', true)
            ->first();

        return ! empty($department);
    }

    public function is_active_employee(string $value): bool
    {
        if (! is_numeric($value)) {
            return false;
        }

        $model = new EmployeeModel();

        $employee = $model
            ->where('id', (int) $value)
            ->where('is_active', true)
            ->first();

        return ! empty($employee);
    }

    public function is_active_visit_purpose(string $value): bool
    {
        if (! is_numeric($value)) {
            return false;
        }

        $model = new VisitPurposeModel();

        $purpose = $model
            ->where('id', (int) $value)
            ->where('is_active', true)
            ->first();

        return ! empty($purpose);
    }
}
