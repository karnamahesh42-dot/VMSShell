<?php

namespace App\Controllers;

use App\Models\VisitorRequestModel;
use App\Models\VisitorLogModel;
use App\Models\VisitorRequestHeaderModel;

  

class VisitorRequest extends BaseController
{
    protected $visitorModel;
    protected $logModel;
    protected $VisitorRequestHeaderModel;


    public function __construct()
    {
        $this->visitorModel = new VisitorRequestModel();
        $this->logModel     = new VisitorLogModel();
        $this->VisitorRequestHeaderModel     = new VisitorRequestHeaderModel();

    }

    public function index(): string
    {
        return view('dashboard/visitorequest');
    }

    public function groupVisitorRequestForm(): string
    {
        return view('dashboard/group_visitor_request');
    }

    /* ------------------------------------------------------------------
        FILE UPLOAD HELPER (Reusable, Fast)
    ------------------------------------------------------------------ */
    private function uploadFile($file, $path)
    {
        if ($file && $file->isValid()) {
            $name = $file->getRandomName();
            $file->move($path, $name);
            return $name;
        }
        return "";
    }

    /* ------------------------------------------------------------------
        MAIL SEND HELPER
    ------------------------------------------------------------------ */
    private function sendMailAsync($payload)
    {
        service('curlrequest')->post(
            base_url('send-email'),
            ['form_params' => $payload]
        );
    }

    /* ------------------------------------------------------------------
        AUTO QR GENERATION (Single Point Control)
    ------------------------------------------------------------------ */
    private function generateQRcode($vCode)
    {
        $fileName = "visitor_{$vCode}_qr.png";
        $qrUrl = "https://quickchart.io/qr?text=" . urlencode($vCode) . "&size=300";
        $savePath = FCPATH . "public/uploads/qr_codes/{$fileName}";

        if (!is_dir(FCPATH . "public/uploads/qr_codes")) {
            mkdir(FCPATH . "public/uploads/qr_codes", 0777, true);
        }

        file_put_contents($savePath, file_get_contents($qrUrl));
        return $fileName;
    }

    /* ------------------------------------------------------------------
        LOG HELPER
    ------------------------------------------------------------------ */
    private function insertLog($id, $action, $old, $new, $remarks = '--')
    {
        $this->logModel->insert([
            'visitor_request_id' => $id,
            'action_type'        => $action,
            'old_status'         => $old,
            'new_status'         => $new,
            'remarks'            => $remarks,
            'performed_by'       => session()->get('user_id'),
        ]);
    }





    /* ==================================================================
       SINGLE VISITOR SUBMIT
    ================================================================== */
    // public function submit()
    // {
    //     if (!$this->request->isAJAX()) return;

    //     // Uploads (optimized)
    //     $vehicleID = $this->uploadFile($this->request->getFile('vehicle_id_proof'), 'public/uploads/vehicle');
    //     $visitorID = $this->uploadFile($this->request->getFile('visitor_id_proof'), 'public/uploads/visitor');

    //     // Auto codes
    //     $codeGen   = new GenerateCodesController();
    //     $vCode     = $codeGen->generateVisitorsCode();
    //     $groupCode = $codeGen->generateGroupVisitorsCode();

    //     $status = (session()->get('role_id') <= 2) ? "approved" : "pending";

    //     // Generate QR only if auto-approved
    //     $qrFile = ($status === 'approved') ? $this->generateQRcode($vCode) : "";

    //     // Prepare Data
    //     $data = [
    //         'v_code'            => $vCode,
    //         'group_code'        => $groupCode,
    //         'visitor_name'      => $this->request->getPost('visitor_name'),
    //         'visitor_email'     => $this->request->getPost('visitor_email'),
    //         'visitor_phone'     => $this->request->getPost('visitor_phone'),
    //         'purpose'           => $this->request->getPost('purpose'),
    //         'proof_id_type'     => $this->request->getPost('proof_id_type'),
    //         'proof_id_number'   => $this->request->getPost('proof_id_number'),
    //         'visit_date'        => $this->request->getPost('visit_date'),
    //         'visit_time'        => $this->request->getPost('visit_time'),
    //         'description'       => $this->request->getPost('description'),
    //         'vehicle_no'        => $this->request->getPost('vehicle_no'),
    //         'vehicle_type'      => $this->request->getPost('vehicle_type'),
    //         'vehicle_id_proof'  => $vehicleID,
    //         'visitor_id_proof'  => $visitorID,
    //         'host_user_id'      => session()->get('user_id'),
    //         'status'            => $status,
    //         'qr_code'           => $qrFile,
    //         'created_by'        => session()->get('user_id'),
    //     ];

    //     // Insert request
    //     $vRequestId = $this->visitorModel->insert($data);

    //     // Log
    //     $this->insertLog($vRequestId, 'Created', null, $status);

    //     // Auto-email for approved requests
    //     if ($status === "approved") {
    //         $mail_data = [
    //             'name'    => $data['visitor_name'],
    //             'email'   => $data['visitor_email'],
    //             'phone'   => $data['visitor_phone'],
    //             'purpose' => $data['purpose'],
    //             'vid'     => $vRequestId,
    //             'v_code'  => $vCode,
    //             'qr_path' => $qrFile,
    //         ];
    //     return $this->response->setJSON(['status' => 'success','mail_data' => $mail_data,'submit_type' => 'admin']);
    //     }

    //     return $this->response->setJSON(['status' => 'success','mail_data' => '','submit_type' =>'user' ]);
    // }

        public function submit()
        {
            if (!$this->request->isAJAX()) return;

            // Uploads
            $vehicleID = $this->uploadFile($this->request->getFile('vehicle_id_proof'), 'public/uploads/vehicle');
            $visitorID = $this->uploadFile($this->request->getFile('visitor_id_proof'), 'public/uploads/visitor');

            // Auto codes
            $codeGen   = new GenerateCodesController();
            $vCode     = $codeGen->generateVisitorsCode();
            $groupCode = $codeGen->generateGroupVisitorsCode();

            $status = (session()->get('role_id') <= 2) ? "approved" : "pending";

            // Generate QR
            $qrFile = ($status === 'approved') ? $this->generateQRcode($vCode) : "";

            /* =======================================================
            STEP 1 — INSERT INTO visitor_request_header FIRST
            ======================================================= */

            $headerData = [
                'header_code'     => $groupCode,
                'requested_by'    => session()->get('user_id'),
                'requested_date'  => date('Y-m-d'),
                'requested_time'  => date('H:i:s'),
                'department'      => 'IT', // static — OR load dynamically
                'total_visitors'  => 1,
                'status'          => $status,
                'remarks'         => $this->request->getPost('purpose'),
            ];

            $headerId = $this->VisitorRequestHeaderModel->insert($headerData);

            /* =======================================================
            STEP 2 — INSERT INTO visitors (link to header)
            ======================================================= */

            $visitorData = [
                'request_header_id'         => $headerId,   // NEW IMPORTANT LINK
                'v_code'            => $vCode,
                'group_code'        => $groupCode,
                'visitor_name'      => $this->request->getPost('visitor_name'),
                'visitor_email'     => $this->request->getPost('visitor_email'),
                'visitor_phone'     => $this->request->getPost('visitor_phone'),
                'purpose'           => $this->request->getPost('purpose'),
                'proof_id_type'     => $this->request->getPost('proof_id_type'),
                'proof_id_number'   => $this->request->getPost('proof_id_number'),
                'visit_date'        => $this->request->getPost('visit_date'),
                'visit_time'        => $this->request->getPost('visit_time'),
                'description'       => $this->request->getPost('description'),
                'vehicle_no'        => $this->request->getPost('vehicle_no'),
                'vehicle_type'      => $this->request->getPost('vehicle_type'),
                'vehicle_id_proof'  => $vehicleID,
                'visitor_id_proof'  => $visitorID,
                'host_user_id'      => session()->get('user_id'),
                'status'            => $status,
                'qr_code'           => $qrFile,
                'created_by'        => session()->get('user_id'),
            ];

            $visitorId = $this->visitorModel->insert($visitorData);

            // Log entry
            $this->insertLog($visitorId, 'Created', null, $status);

            // Auto email logic
            if ($status === "approved") {
                $mail_data = [
                    'name'    => $visitorData['visitor_name'],
                    'email'   => $visitorData['visitor_email'],
                    'phone'   => $visitorData['visitor_phone'],
                    'purpose' => $visitorData['purpose'],
                    'vid'     => $visitorId,
                    'v_code'  => $vCode,
                    'qr_path' => $qrFile,
                ];
                return $this->response->setJSON([
                    'status' => 'success',
                    'mail_data' => $mail_data,
                    'submit_type' => 'admin'
                ]);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'mail_data' => '',
                'submit_type' => 'user'
            ]);
        }


/* ==================================================================
   GROUP VISITOR SUBMIT (Return mail data for all approved visitors)
================================================================== */
public function groupSubmit()
{
    if (!$this->request->isAJAX()) return;

    $codeGen = new GenerateCodesController();
    $groupCode = $codeGen->generateGroupVisitorsCode();

    $names  = $this->request->getPost('visitor_name');
    $emails = $this->request->getPost('visitor_email');
    $phones = $this->request->getPost('visitor_phone');

    $autoApprove = (session()->get('role_id') <= 2);

    $vehicleFiles = $this->request->getFileMultiple('vehicle_id_proof');
    $visitorFiles = $this->request->getFileMultiple('visitor_id_proof');

    $mailDataList = [];   // <===== COLLECT MAIL DATA HERE

    foreach ($names as $i => $name)
    {
        $vCode  = $codeGen->generateVisitorsCode();
        $status = $autoApprove ? "approved" : "pending";

        // Generate QR only if approved
        $qrFile = $autoApprove ? $this->generateQRcode($vCode) : "";

        // Prepare row data
        $data = [
            'v_code'            => $vCode,
            'group_code'        => $groupCode,
            'visitor_name'      => $name,
            'visitor_email'     => $emails[$i],
            'visitor_phone'     => $phones[$i],
            'purpose'           => $this->request->getPost('purpose')[$i],
            'proof_id_type'     => $this->request->getPost('proof_id_type')[$i],
            'proof_id_number'   => $this->request->getPost('proof_id_number')[$i],
            'visit_date'        => $this->request->getPost('visit_date')[$i],
            'visit_time'        => $this->request->getPost('visit_time')[$i],
            'description'       => $this->request->getPost('description')[$i],
            'vehicle_no'        => $this->request->getPost('vehicle_no')[$i],
            'vehicle_type'      => $this->request->getPost('vehicle_type')[$i],
            'vehicle_id_proof'  => $this->uploadFile($vehicleFiles[$i], 'public/uploads/vehicle'),
            'visitor_id_proof'  => $this->uploadFile($visitorFiles[$i], 'public/uploads/visitor'),
            'host_user_id'      => session()->get('user_id'),
            'status'            => $status,
            'qr_code'           => $qrFile,
            'created_by'        => session()->get('user_id'),
        ];

        // Insert DB record
        $vRequestId = $this->visitorModel->insert($data);

        $this->insertLog($vRequestId, 'Created', null, $status);

        // If approved → push mail data into array
        if ($autoApprove) 
        {
            $mailDataList[] = [
                'name'    => $name,
                'email'   => $emails[$i],
                'phone'   => $phones[$i],
                'purpose' => $data['purpose'],
                'vid'     => $vRequestId,
                'v_code'  => $vCode,
                'qr_path' => $qrFile
            ];
        }
    }

    return $this->response->setJSON([
        'status'      => 'success',
        'submit_type' => $autoApprove ? 'admin' : 'user',
        'mail_data'   => $mailDataList   // SEND MAIL DATA BACK
    ]);
}



    /* ==================================================================
       APPROVAL PROCESS
    ================================================================== */
    public function approvalProcess()
    {
        $id     = $this->request->getPost('id');
        $status = $this->request->getPost('status');
        $vCode  = $this->request->getPost('v_code');
        $remark = $this->request->getPost('comment');

        $visitor = $this->visitorModel->find($id);

        $this->insertLog($id, $status, $visitor['status'], $status, $remark);

        if ($status === "approved") {

            $qrFile = $this->generateQRcode($vCode);

            $this->visitorModel->update($id, [
                'qr_code' => $qrFile,
                'status'  => $status
            ]);

            return $this->response->setJSON([
                "status"    => "success",
                "message"   => "Action completed successfully!",
                "mail_data" => [
                    'name'    => $visitor['visitor_name'],
                    'email'   => $visitor['visitor_email'],
                    'phone'   => $visitor['visitor_phone'],
                    'purpose' => $visitor['purpose'],
                    'vid'     => $id,
                    'v_code'  => $vCode,
                    'qr_path' => $qrFile
                ]
            ]);
        }

        return $this->response->setJSON(["status" => "success"]);
    }

    /* ==================================================================
       VISITOR LIST
    ================================================================== */
    public function visitorDataListView()
    {
        return view('dashboard/visitorrequestlist');
    }

    public function visitorData()
    {
        $role = session()->get('role_id');
        $uid  = session()->get('user_id');

        $query = $this->visitorModel->orderBy('id', 'DESC');

        if ($role == 3) {
            $query->where('created_by', $uid);
        }

        return $this->response->setJSON($query->findAll());
    }

    public function getVisitorRequastDataById($id)
    {
        return $this->response->setJSON(
            $this->visitorModel->find($id)
        );
    }
}
