<?php

namespace App\Models;

use CodeIgniter\Model;

class SecurityGateLogModel extends Model
{
    protected $table = 'security_gate_logs';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'visitor_request_id',
        'v_code',
        'check_in_time',
        'check_out_time',
        'verified_by'
    ];

    protected $useTimestamps = false; // We are manually storing times
    


    public function getRecentAuthorized($limit = 10)
    {
        return $this->select("
                    security_gate_logs.*,
                    visitors.visitor_name,
                    visitors.visitor_phone,
                    visitors.purpose,
                    visitors.v_code
                ")
                ->join('visitors', 'visitors.id = security_gate_logs.visitor_request_id', 'left')
                ->where('visitors.status', 'approved') // Only authorized
                ->orderBy('security_gate_logs.check_in_time', 'DESC')
                ->limit($limit)
                ->find();
    }


    public function getRecentAuthorizedForSecurityList($limit = 50)
    {
        return $this->select("
                security_gate_logs.*,
                visitors.visitor_name,
                visitors.visitor_phone,
                visitors.purpose,
                visitors.v_code,
                visitor_request_header.department AS department_name,
                users.name AS created_by_name
            ")
            ->join('visitors', 'visitors.id = security_gate_logs.visitor_request_id', 'left')
            ->join('visitor_request_header', 'visitor_request_header.id = visitors.request_header_id', 'left')
            ->join('users', 'users.id = visitors.created_by', 'left') 
            ->where('visitors.status', 'approved')
            ->orderBy('security_gate_logs.check_in_time', 'DESC')
            ->limit($limit)
            ->find();
    }

}
