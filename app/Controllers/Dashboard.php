<?php

namespace App\Controllers;

use App\Models\VisitorRequestModel;
use App\Models\VisitorLogModel;
use App\Models\SecurityGateLogModel;
use App\Models\VisitorRequestHeaderModel;


class Dashboard extends BaseController
{
    protected $visitorModel;
    protected $logModel;
    protected $SecurityGateLogModel;
    protected $VisitorRequestHeaderModel;

    

    public function __construct()
    {
        $this->visitorModel = new VisitorRequestModel();
        $this->logModel     = new VisitorLogModel();
        $this->SecurityGateLogModel     = new SecurityGateLogModel();
        $this->VisitorRequestHeaderModel     = new VisitorRequestHeaderModel();

    }

    public function index()
    {
        // Dynamic counts from DB
        $totalVisitors = $this->visitorModel->countAll(); // total rows

        $pendingIndents = $this->VisitorRequestHeaderModel
                            ->where('status', 'pending')
                            ->countAllResults();

        $approved = $this->VisitorRequestHeaderModel
                            ->where('status', 'approved')
                            ->countAllResults();

        $rejected = $this->VisitorRequestHeaderModel
                            ->where('status', 'rejected')
                            ->countAllResults();


        // Visits today
        $today = date('Y-m-d');
        $visitsToday = $this->VisitorRequestHeaderModel
                            ->where('requested_date', $today)
                            ->countAllResults();

        // Gate entries (from logs table?)
        $gateEntries = $this->SecurityGateLogModel->countAll();

        // Prepare card data
        $data['smallCards'] = [
            ['title'=>'Total Visitors','value'=>$totalVisitors,'icon'=>'fa-user','color'=>'c1'],
            ['title'=>'Pending Requests','value'=>$pendingIndents,'icon'=>'fa-file-alt','color'=>'c2'],
            ['title'=>'Approved','value'=>$approved,'icon'=>'fa-check-circle','color'=>'c3'],
            ['title'=>'Rejected','value'=>$rejected,'icon'=>'fa-times-circle','color'=>'c4'],
            ['title'=>'Gate Entries','value'=>$gateEntries,'icon'=>'fa-door-open','color'=>'c5'],
            ['title'=>'Visits Today','value'=>$visitsToday,'icon'=>'fa-calendar-day','color'=>'c6'],
        ];


            $pendingList = $this->VisitorRequestHeaderModel
                ->select("
                    id,
                    header_code,
                    purpose,
                    requested_date,
                    requested_time,
                    total_visitors,
                    status
                ")
                ->where('status', 'pending')
                ->orderBy('id', 'DESC')
                ->limit(5)
                ->findAll();

            $data['pendingList'] = $pendingList;

        return view('dashboard/dashboard', $data);
    }
}
