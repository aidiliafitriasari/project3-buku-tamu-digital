<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table            = 'activity_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'user_id',
        'visit_id',
        'visit_status_history_id',
        'activity',
        'module',
        'description',
        'created_at',
    ];

    protected $useTimestamps = false;
}
