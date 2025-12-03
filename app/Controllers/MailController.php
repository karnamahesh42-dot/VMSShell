<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class MailController extends Controller
{
    public function sendMail()
    {
        try {
            // ------------------------------
            // Get POST Data
            // ------------------------------
             // $email   = $this->request->getPost("email");  // use actual visitor email
            $email   = 'karnamahesh42@gmail.com';  // use actual visitor email
            $name    = $this->request->getPost("name");
            $phone   = $this->request->getPost("phone");
            $purpose = $this->request->getPost("purpose");
            $v_code  = $this->request->getPost("v_code");
            $qr_path  = $this->request->getPost("qr_path");

            // ------------------------------
            // Build QR Image Path
            // ------------------------------
            $qrFile = FCPATH . 'public/uploads/qr_codes/'.$qr_path;
           
            if (!file_exists($qrFile)) {
                return $this->response->setJSON([
                    "status"  => "error",
                    "message" => "QR File Missing",
                    "path"    => $qrFile
                ]);
            }

            // ------------------------------
            // Base64 for HTML Template
            // ------------------------------
            // $qrBase64 = base64_encode(file_get_contents($qrFile));
            // $qrDataURI = "data:image/png;base64," . $qrBase64;

            // ------------------------------
            // Template Data
            // ------------------------------
            $data = [
                "name"     => $name,
                "phone"    => $phone,
                "purpose"  => $purpose,
                "v_code"   => $v_code,
                // "qrBase64" => $qrDataURI,
                "qr_url"   => base_url('public/uploads/qr_codes/'.$qr_path)
            ];

            // ------------------------------
            // Load Email Service (Auto Reads .env)
            // ------------------------------
            $emailService = \Config\Services::email();

            $emailService->setTo($email);
           
            // From Address (correct .env keys)
            $emailService->setFrom(
                env('app.email.fromEmail'),
                env('app.email.fromName')
            );

            $emailService->setSubject("Your Visitor QR Code");

            // Load the HTML template
            $emailService->setMessage(
                view("emails/visitor_mail_template", $data)
            );

            // Set QR Attachement 
             $emailService->attach($qrFile);
            // ------------------------------
            // Send Email
            // ------------------------------
            if ($emailService->send()) {
                return $this->response->setJSON([
                    "status" => "success",
                    "message" => "Mail Sent Successfully!"
                ]);
            }

            return $this->response->setJSON([
                "status" => "error",
                "debug"  => $emailService->printDebugger()
            ]);

        } catch (\Exception $e) {

            return $this->response->setJSON([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
    }
}
