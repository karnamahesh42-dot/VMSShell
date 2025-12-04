<?= $this->include('/dashboard/layouts/sidebar') ?>
  <?= $this->include('/dashboard/layouts/navbar') ?>
     
   <main class="main-content" id="mainContent">
        <div class="container-fluid">
             <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-sm-8 col-8">

            <!-- Search Box -->
                <div class="card card-primary">
                    <div class="card-header text-white d-flex align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-qrcode"></i> Visitor Access Verification
                        </h5>

                        <button id="toggleAutoScan" class="btn btn-light btn-sm ms-auto">
                            <i class="fas fa-check-circle"></i> Auto Scan: ON
                        </button>

                        <!-- Auto Scan Hidden Input -->
                         <input type="hidden" value="" id="auto_scan_btn">
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <label class="fw-bold">Scan / Enter V-Code</label>

                            <div class="col-9 col-md-9 col-sm-9">
                                <input type="text" id="vcodeInput" class="form-control"
                                    placeholder="Example: V00001 or Scan QR">
                            </div>

                            <div class="col-3 col-md-3 col-sm-3">
                                <a href="#" class="btn btn-primary" id="searchBtn">
                                    <i class="fas fa-search"></i> Verify
                                </a>
                            </div>

                            <small class="text-muted mt-2">
                                <label><b>Note :</b></label>
                                Security can manually enter the V-Code or scan it using a gate QR scanner.
                            </small>
                        </div>
                    </div>
                </div>
         <!-- Search Box End -->

                    <!-- Visitor Details Card Start -->

                <div id="visitorDetails" class="card visitor-details-card">

                    <div class="card-header bg-success text-white">
                    
                        <h5 class="mb-0">Visitor Information</h5>
                        
                    </div>

                    <div class="card-body">

                        <!-- PROFILE + STATUS IN SAME LINE -->
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <!-- Profile Section -->
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light p-3 me-3 border">
                                    <i class="fas fa-user text-primary fa-2x"></i>
                                </div>
                                <div>
                                    <h5 id="vName" class="mb-0 text-primary"></h5>
                                    <span id="vEmail" class="text-muted small"></span></br>
                                    <span id="vCode" class="text-muted small text-bold"></span>
                                </div>
                            </div>

                            <!-- Status Badge (Right Side) -->
                            <span id="vStatus" class="badge px-3 py-2"></span>

                        </div>

                        <hr>

                        <!-- Two Column Layout -->
                        <div class="row">

                            <div class="col-md-6">
                                <p><b>Phone :</b> <span id="vPhone"></span></p>
                                <p><b>Purpose :</b> <span id="vPurpose"></span></p>
                                <p><b>Group Code :</b> <span id="vGroupCode"></span></p>
                                <p><b>Vehicle No :</b> <span id="vVehicleNo"></span></p>
                            </div>

                            <div class="col-md-6">
                                <p><b>Exp Visit Date :</b> <span id="vExpVisitDate"></span></p>
                                <p><b>Exp Visit Time :</b> <span id="vExpVisitTime"></span></p>
                                <p><b>Id Proof Type :</b> <span id="vIdProofType"></span></p>
                                <p><b>Id Proof No :</b> <span id="vIdProofNo"></span></p>
                            <input type="hidden" id="visitorRequestId">


                            <div class="col-md-12">
                                <p><b>Description:</b> <span id="vDescription"></span></p>
                            </div>

                        </div>

                        <input type="hidden" id="visitorRequestId">
                        <input type="hidden" id="securityCheckStatus">

                        <!-- Action Buttons -->
                        <div class="mt-4">
                            <button class="btn btn-success w-100 mb-2 d-none" id="allowEntryBtn">
                                <i class="fas fa-door-open"></i> Allow Entry
                            </button>

                            <button class="btn btn-danger w-100 d-none" id="markExitBtn">
                                <i class="fas fa-door-closed"></i> Mark Exit
                            </button>
                        </div>
                    </div>
                </div>
                    <!-- Visitor Details Card End -->
                </div>
            </div>
        </div>
    </main>

<?= $this->include('/dashboard/layouts/footer') ?>


<!-- JS -->
<script>


$(document).ready(function () {

    let autoScan = true; // default ON
    $('#auto_scan_btn').val('on');
    // Focus input on load
    setTimeout(() => $("#vcodeInput").focus(), 300);

    // Auto Scan Toggle Button
    $("#toggleAutoScan").click(function () {
        autoScan = !autoScan;
        if (autoScan) {
            $(this).html('<i class="fas fa-check-circle"></i> Auto Scan: ON');
            $(this).removeClass("btn-danger").addClass("btn-light");
             $('#auto_scan_btn').val('on');
        } else {
            $(this).html('<i class="fas fa-times-circle"></i> Auto Scan: OFF');
            $(this).removeClass("btn-light").addClass("btn-danger");
            $('#auto_scan_btn').val('off');
        }
        setTimeout(() => $("#vcodeInput").focus(), 300);
    });

    // Auto verify when autoScan is true
    $("#vcodeInput").on("input", function () {
        if (!autoScan) return;  // ignore when OFF

        let code = $(this).val().trim();

        if (code.length === 7) {   // V000008 (7 chars)
            $("#searchBtn").click();
        }
    });
});




// -----------------------------------------------------
//  MANUAL + AUTO VERIFY FUNCTION (ALREADY TRIGGERED BY AUTO SCAN)
// -----------------------------------------------------
$("#searchBtn").on('click', function () {

    let vcode = $("#vcodeInput").val().trim();

    if (vcode === "") {
        Swal.fire("Required", "Please enter a V-Code.", "warning");
        return;
    }

    $.ajax({
        url: "<?= base_url('/security/verify') ?>",
        type: "POST",
        data: { v_code: vcode },
        success: function (res) {

            if (res.status === "error") {
              
                Swal.fire({icon:"error",title:"Not Found",text:"Visitor record not found!",timer:1500,timerProgressBar:true,showConfirmButton:false});
                return;
            }

            if (res.status === "not_approved") {
              
                  Swal.fire({icon:"warning",title:"Not Approved",text:"Visitor is not approved yet.",timer:1500,timerProgressBar:true,showConfirmButton:false});
                return;
            }

            // Show the card
            $("#visitorDetails").removeClass("d-none");

            // Fill visitor data
            $("#visitorRequestId").val(res.visitor.id);
            $("#vName").text(res.visitor.visitor_name);
            $("#vPhone").text(res.visitor.visitor_phone);
            $("#vEmail").text(res.visitor.visitor_email);
            $("#vPurpose").text(res.visitor.purpose);
            $('#vCode').text(res.visitor.v_code)
            $("#vGroupCode").text(res.visitor.group_code);
            $("#vVehicleNo").text(res.visitor.vehicle_no);
            $("#vExpVisitTime").text(res.visitor.visit_time);
            $("#vExpVisitDate").text(res.visitor.visit_date);
            $("#vIdProofNo").text(res.visitor.proof_id_number);
            $("#vIdProofType").text(res.visitor.proof_id_type);
            $("#vDescription").text(res.visitor.description);

            // Status Badge
            let badge = $("#vStatus");
            badge.removeClass("bg-secondary bg-warning bg-success text-dark");

            if (res.visitor.securityCheckStatus == 0) {
                badge.text("Not Entered").addClass("bg-secondary");
            }
            else if (res.visitor.securityCheckStatus == 1) {
                badge.text("Inside").addClass("bg-warning text-dark");
            }
            else if (res.visitor.securityCheckStatus == 2) {
                badge.text("Completed").addClass("bg-success");
            }

            // Show / Hide Buttons Manually
            $("#allowEntryBtn").addClass("d-none");
            $("#markExitBtn").addClass("d-none");

            if (res.visitor.securityCheckStatus == 0) {
                $("#allowEntryBtn").removeClass("d-none");
            }
            if (res.visitor.securityCheckStatus == 1) {
                $("#markExitBtn").removeClass("d-none");
            }

            // -------------------------------------
            // AUTO APPROVAL (AUTO CHECK-IN)
            // -------------------------------------
            
            if (res.visitor.securityCheckStatus == 0 && $('#auto_scan_btn').val() == "on") {
                 console.log("Auto approving entry...");
                 $("#allowEntryBtn").click();
            }
        
            $("#vcodeInput").val('');

        }
    });
});



// -----------------------------------------------------
//  ALLOW ENTRY (CHECK-IN)
// -----------------------------------------------------
$("#allowEntryBtn").on('click', function () {

    $.ajax({
        url: "<?= base_url('/security/checkin') ?>",
        type: "POST",
        data: {
            visitor_request_id: $("#visitorRequestId").val(),
            v_code: $('#vCode').text()
        },
        success: function (res) {

            if (res.status === "exists") {
                
                alert(res.status);
                Swal.fire({icon:"info",title:"Already Inside",text:"Visitor already checked in.",timer:1500,timerProgressBar:true,showConfirmButton:false});
                return;
            }

             $("#vStatus").text("Inside").addClass("bg-warning text-dark");
             $("#allowEntryBtn").addClass("d-none");
             $("#markExitBtn").removeClass("d-none");
             Swal.fire({icon:"success",title:"success",text:"Visitor entry recorded.",timer:1500,timerProgressBar:true,showConfirmButton:false});

        }
    });
});



// -----------------------------------------------------
//  MARK EXIT
// -----------------------------------------------------
$("#markExitBtn").on('click', function () {

    $.ajax({
        url: "<?= base_url('/security/checkout') ?>",
        type: "POST",
        data: { visitor_request_id: $("#visitorRequestId").val() },
        success: function (res) {

            if (res.status === "no_entry") {
                // Swal.fire("No Entry", "Visitor has no entry record.", "warning");
                Swal.fire({icon:"warning",title:"No Entry",text:"Visitor has no entry record.",timer:1500,timerProgressBar:true,showConfirmButton:false});
                return;
            }
            
            $("#vStatus").removeClass("bg-warning text-dark");
            $("#vStatus").text("Completed").addClass("bg-success");
            $("#markExitBtn").addClass("d-none");
            // Swal.fire("Recorded", "Visitor exit recorded.", "success");
            Swal.fire({icon:"success",title:"Recorded",text:"Visitor exit recorded.",timer:1500,timerProgressBar:true,showConfirmButton:false});

        }
    });
});

</script>
