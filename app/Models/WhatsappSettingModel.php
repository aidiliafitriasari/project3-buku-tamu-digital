<?php

namespace App\Models;

use CodeIgniter\Model;

class WhatsappSettingModel extends Model
{
    protected $table            = 'whatsapp_settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'is_enabled',
        'api_url',
        'api_key',
        'guest_enabled',
        'guest_template',
        'employee_enabled',
        'employee_template',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
