<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitModel extends Model
{
    protected $table            = 'visits';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'guest_id',
        'visit_code',
        'qr_token',
        'origin_institution',
        'department_id',
        'employee_id',
        'visit_purpose_id',
        'group_count',
        'data_consent',
        'arrival_at',
        'status',
        'photo',
        'signature',
        'checkin_at',
        'checkout_at',
        'duration',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
