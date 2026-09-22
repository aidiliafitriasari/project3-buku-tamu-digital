<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitStatusHistoryModel extends Model
{
    protected $table            = 'visit_status_histories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'visit_id',
        'user_id',
        'status',
    ];

    protected $useTimestamps = false;
}
