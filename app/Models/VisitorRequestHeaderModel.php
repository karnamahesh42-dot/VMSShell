<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorRequestHeaderModel extends Model
{
    protected $table            = 'visitor_request_header';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields = [
        'header_code',
        'requested_by',
        'requested_date',
        'requested_time',
        'department',
        'total_visitors',
        'status',
        'remarks'
    ];

    // Optional timestamps if table has created_at / updated_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
