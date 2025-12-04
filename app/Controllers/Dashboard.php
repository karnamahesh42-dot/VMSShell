<?php

namespace App\Controllers;

use App\Models\VisitorRequestModel;
use App\Models\VisitorLogModel;
use App\Models\SecurityGateLogModel;


class Dashboard extends BaseController
{
    protected $visitorModel;
    protected $logModel;
    protected $SecurityGateLogModel;

    public function __construct()
    {
        $this->visitorModel = new VisitorRequestModel();
        $this->logModel     = new VisitorLogModel();
         $this->SecurityGateLogModel     = new SecurityGateLogModel();
    }

    public function index()
    {
        // Dynamic counts from DB
        $totalVisitors = $this->visitorModel->countAll(); // total rows

        $pendingIndents = $this->visitorModel
                            ->where('status', 'pending')
                            ->countAllResults();

        $approved = $this->visitorModel
                            ->where('status', 'approved')
                            ->countAllResults();

        $rejected = $this->visitorModel
                            ->where('status', 'rejected')
                            ->countAllResults();


        // Visits today
        $today = date('Y-m-d');
        $visitsToday = $this->visitorModel
                            ->where('visit_date', $today)
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

        return view('dashboard/dashboard', $data);
    }
}
