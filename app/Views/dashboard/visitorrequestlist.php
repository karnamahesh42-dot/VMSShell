<?= $this->include('/dashboard/layouts/header') ?>
<?= $this->include('/dashboard/layouts/sidebar') ?>

<!--begin::App Main-->
<main class="app-main">

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Visitor Request</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Visitor Request</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <div class="app-content">
        <div class="container-fluid">

            <div class="row d-flex justify-content-center">
        

                <!-- Satart view Visitor Request Form Pop-Up  -->
                    <div class="modal fade" id="visitorModal">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Visitor Details</h5>
                        <!-- <button type="button" class="close" data-bs-dismiss="modal">&times;</button> -->
                        </div>

                        <div class="modal-body">

                        <table class="table table-bordered">
                            <tr><th>Name</th> <td id="v_name"></td></tr>
                            <tr><th>Email</th> <td id="v_email"></td></tr>
                            <tr><th>Phone</th> <td id="v_phone"></td></tr>
                            <tr><th>Purpose</th> <td id="v_purpose"></td></tr>
                            <tr><th>ID Type</th> <td id="v_id_type"></td></tr>
                            <tr><th>ID Number</th> <td id="v_id_number"></td></tr>
                            <tr><th>Visit Date</th> <td id="v_date"></td></tr>
                            <tr><th>Description</th> <td id="v_desc"></td></tr>
                            <tr><th>QR Code</th> <td><img id="v_qr" src="" width="150"></td> 
                            <input type="hidden" id="qr_path" value="">
                        </tr>
                            <tr><th>V-Code</th> <td id="v_code"></td></tr>
                            
                            <tr id="action_row"><th>Actions</th> <th id='buttonContainer'></th></tr>
                            <input type="hidden" id="v_id" value="test">
                        </table>
                        </div>
                        <div class="modal-footer">
                        <button class="btn btn-success"  onclick="resendqr()" id="re-sendButton">Re-Send QR</button>
                        <button class="btn btn-danger text-end" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                    </div>

                <!-- End view Visitor Request Form Pop-Up  -->

                    <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Visitor Request List</h3>

                        <div class="card-tools">
                            <div class="" >
                            <!-- <input type="button" name="add" class="form-control float-right" placeholder="Search"> -->
                             <a href="<?= base_url('group_visito_request') ?>" class="btn btn-warning mx-1"> <i class="fa-solid fa-users"></i> Group Request</a>
                            <a href="<?= base_url('visitorequest') ?>" class="btn btn-warning mx-1"> <i class="fa-solid fa-user"></i> New Request</a>
                            </div>
                        </div>
                        </div>
                        <!-- /.card-header -->
                         <!-- /.card-body -->
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped"  id="visitorTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>#</th>
                                             <th>V-Code</th>
                                            <th>Visitor</th>
                                            <th>Visit Date</th>
                                            <th>Purpose</th>
                                            <th>Phone</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <?php if($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '2'){?>
                                            <th style="width:150px;">Actions</th>
                                             <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </div>
</main>
<!--end::App Main-->

<?= $this->include('/dashboard/layouts/footer') ?>

<script>

$(document).ready(function() {
    loadVisitorList();
});

// 👉 CORRECT function
function loadVisitorList() {

    $.ajax({
        url: "<?= base_url('/visitorlistdata') ?>",
        type: "GET",
        dataType: "json",
        success: function(data) {

            let rows = "";
            let i = 1;

            data.forEach(function(item){

                // Status badge
                let statusBadge =
                    item.status === "approved" ? `<span class="badge bg-success">Approved</span>` :
                    item.status === "rejected" ? `<span class="badge bg-danger">Rejected</span>` :
                    `<span class="badge bg-warning">Pending</span>`;

                // Action buttons only for pending
                let actions = "";
                if (item.status === "pending") {
                    actions = `
                        <button class="btn btn-success btn-sm approvalBtn mx-1" onclick = approvalProcess(${item.id},'approved','${item.v_code}','') ><i class="fa-solid fa-check"></i></button>
                        <button class="btn btn-danger btn-sm approvalBtn mx-1" onclick = rejectComment(${item.id},'rejected','${item.v_code}','') ><i class="fa-solid fa-xmark"></i></button>
                    `;
                } else {
                    actions = `<span class="text-muted">--</span>`;
                }

                rows += `
                    <tr>
                        <td>${i++}</td>
                        <td>${item.v_code}</td>
                        <td>${item.visitor_name}</td>
                        <td>${item.visit_date}</td>
                        <td>${item.purpose}</td>
                        <td>${item.visitor_phone}</td>
                        <td>${item.description ?? ''}</td>
                        <td>${statusBadge}</td>
                         <?php if($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '2'){?>
                        <td>${actions}</td>
                        <?php } ?>
                        <td>
                        <button class="btn btn-info btn-sm viewBtn" data-id="${item.id}">
                        <i class="fa-solid fa-eye"></i>
                        </button>
                        </td>
                    </tr>
                `;
            });

            $("#visitorTable tbody").html(rows);
        }
    });
}


$(document).on("click", ".viewBtn", function () {

    let id = $(this).data("id");
    $.ajax({
        url: "<?= base_url('getvisitorrequestdata/') ?>" + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            $("#v_name").text(data.visitor_name);
            $("#v_email").text(data.visitor_email);
            $("#v_phone").text(data.visitor_phone);
            $("#v_purpose").text(data.purpose);
            $("#v_id_type").text(data.proof_id_type);
            $("#v_id_number").text(data.proof_id_number);
            $("#v_date").text(data.visit_date);
            $("#v_desc").text(data.description);
            $("#v_id").val(data.id);
            $("#v_code").text(data.v_code);
            $("#qr_path").val(data.qr_code);
          
            
            <?php if($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '2'){ ?>
              $("#action_row").show();
           <?php }else{?>
              $("#action_row").hide();
            <?php } ?> 

            if (data.qr_code) {
                $("#v_qr").attr("src", "<?= base_url('public/uploads/qr_codes/') ?>" + data.qr_code);
            } else {
                $("#v_qr").attr("src", "");
            }

            let buttons = '- -'
            if(data.status == 'pending'){
                $("#re-sendButton ").hide();
               buttons = `
                <button class="btn btn-success btn-sm approvalBtn" onclick = approvalProcess(${data.id},'approved','${data.v_code}','') >Approve</button>
                <button class="btn btn-danger btn-sm approvalBtn" onclick = rejectComment(${data.id},'rejected','${data.v_code}','') >Reject</button>`;
            }else{
                 $("#re-sendButton ").show();
            }
              $("#buttonContainer").html(buttons);
    
            $("#visitorModal").modal("show");
        }
    });
});





// Resend QR To Mail Function 
function resendqr() {
    let name = $("#v_name").text();
    let email = $("#v_email").text();
    let phone = $("#v_phone").text();
    let purpose = $("#v_purpose").text();
    let vid = $('#v_id').val(); // << QR Image URL or Base64
    let v_code = $('#v_code').text(); // V_Code
    let qr_path = $('#qr_path').val(); // rq_path
    
    $.ajax({
        url: "<?= base_url('send-email') ?>",
        type: "POST",
        data: {
            name: name,
            email: email,
            phone: phone,
            purpose: purpose,
            vid: vid,
            v_code: v_code,
            qr_path: qr_path
        },
        dataType: "json",
        success: function(data) {
        }
    });

    Swal.fire({
        position: 'top-end',
        toast: true,
        icon: 'success',
        title: 'Mail Sent Successfully',
        showConfirmButton: false,
        timer: 2000
    });
}



function rejectComment(id, status, vcode, comment) {
    Swal.fire({
        title: "Reject Visitor Request",
        input: "text",
        inputLabel: "Enter rejection comment",
        inputPlaceholder: "Write your comment...",
        showCancelButton: true,
        confirmButtonText: "Submit",
    }).then((result) => {
        if (result.isConfirmed) {

            let comment = result.value; // user comment
            // Call your approval process with comment
            approvalProcess(id, status, vcode, comment);
        }
    });
}



function approvalProcess(id, status, vcode, comment) {

    // 1️⃣ Show loader
    Swal.fire({
        title: 'Processing...',
        text: 'Please wait',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: "<?= base_url('/approvalprocess') ?>",
        type: "POST",
        data: { id: id, status: status, v_code: vcode, comment : comment},
        dataType: "json",

        success: function (res) {
            // 2️⃣ Close loader
            Swal.close();
            // 3️⃣ Show result popup
            if (res.status === "success") {
             Swal.fire({
                    icon: 'success',
                    title: 'Action Completed Successfully!',
                    showConfirmButton: false,
                    timer: 1000
                });
                // 4️⃣ Refresh visitor list

                
                loadVisitorList();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed!',
                    text: res.message ?? "Please try again",
                    confirmButtonColor: '#d33'
                });
            }
        },

        error: function () {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Server Error!',
                text: 'Something went wrong.',
                confirmButtonColor: '#d33'
            });
        }
    });
}

</script>

