  <?= $this->include('/dashboard/layouts/sidebar') ?>
  <?= $this->include('/dashboard/layouts/navbar') ?>
     
   <main class="main-content" id="mainContent">
        <div class="container-fluid">
           <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header py-2">
                            <h3 class="card-title m-0">Visitor Request</h3>
                        </div>

                        <form id="visitorForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="table-responsive dynamic-form-table">
                                    <table class="table table-bordered" id="visitorGrid">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Visitor Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>ID Type</th>
                                                <th>ID Number</th>
                                                <th>Purpose</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Vehicle No</th>
                                                <th>Vehicle Type</th>
                                                <th>Description</th>
                                                <th>Vehicle ID Proof</th>
                                                <th>Visitor ID Proof</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!-- Default Row -->
                                            <tr>
                                                <td>
                                                    <lable>1</lable>
                                                    <!-- <input type="text" name="group_code[]" class="form-control group-code" value="1" readonly> -->
                                                </td>

                                                <td><input type="text" name="visitor_name[]" class="form-control" required></td>

                                                <td><input type="email" name="visitor_email[]" class="form-control" required></td>

                                                <td><input type="text" name="visitor_phone[]" class="form-control" required></td>

                                                <td>
                                                    <select name="proof_id_type[]" class="form-control" required>
                                                        <option value="">Select</option>
                                                        <option>Aadhar Card</option>
                                                        <option>PAN Card</option>
                                                        <option>Voter ID</option>
                                                        <option>Passport</option>
                                                        <option>Driving License</option>
                                                        <option>Employee / Student ID</option>
                                                        <option>Other</option>
                                                    </select>
                                                </td>

                                                <td><input type="text" name="proof_id_number[]" class="form-control" required></td>

                                                <td>
                                                    <select name="purpose[]" class="form-control" required>
                                                        <option value="">Purpose</option>
                                                        <option>General Visit</option>
                                                        <option>Meeting</option>
                                                        <option>Interview</option>
                                                        <option>Document Submission</option>
                                                        <option>Verification / Approval</option>
                                                        <option>Event Visit</option>
                                                        <option>Personal Visit</option>
                                                        <option>Site Inspection</option>
                                                        <option>Maintenance / Service</option>
                                                        <option>Other</option>
                                                    </select>
                                                </td>

                                                <td><input type="date" name="visit_date[]" class="form-control" required></td>

                                                <td><input type="time" name="visit_time[]" class="form-control" required></td>
                                                
                                                <td><input type="text" name="vehicle_no[]" class="form-control"></td>
                                                
                                                <td><select name="vehicle_type[]" class="form-control">
                                                    <option value="">-- Select Vehicle Type --</option>
                                                    <option>Bike</option>
                                                    <option>Car</option>
                                                    <option>Van</option>
                                                    <option>Bus</option>
                                                    <option>Auto</option>
                                                    <option>Truck</option>
                                                    </select></td>

                                                <td><textarea name="description[]" class="form-control" rows="2" ></textarea></td>
                                            
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-primary btn-sm uploadBtn">
                                                       <i class="fa-solid fa-file-arrow-up"></i>
                                                    </button>
                                                    <input type="file" name="vehicle_id_proof[]" class="fileInput d-none">
                                                </td>

                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-primary btn-sm uploadBtn">
                                                     <i class="fa-solid fa-file-arrow-up"></i>
                                                    </button>
                                                    <input type="file" name="visitor_id_proof[]" class="fileInput d-none">
                                                </td>
                                                   
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm addRow"> <i class="fa-solid fa-user-plus"></i> </button>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>

                                <!-- Hidden -->
                                <input type="hidden" name="host_user_id" value="<?= $_SESSION['user_id']; ?>">
                            </div>

                            <div class="card-footer py-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('visitorequestlist') ?>" class="btn btn-danger float-right">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
         </div>
    </main>

<?= $this->include('/dashboard/layouts/footer') ?>


<!-- Dynamic Row Script -->
<script>
let groupIndex = 1;

let serial = 1;

$(document).on('click', '.addRow', function(){

    serial++;

    let row = `
        <tr>
            <td>
              <lable>${serial}</lable>
            </td>
            <td><input type="text" name="visitor_name[]" class="form-control" required></td>
            <td><input type="email" name="visitor_email[]" class="form-control" required></td>
            <td><input type="text" name="visitor_phone[]" class="form-control" required></td>

            <td>
                <select name="proof_id_type[]" class="form-control" required>
                    <option value="">Select</option>
                    <option>Aadhar Card</option>
                    <option>PAN Card</option>
                    <option>Voter ID</option>
                    <option>Passport</option>
                    <option>Driving License</option>
                    <option>Employee / Student ID</option>
                    <option>Other</option>
                </select>
            </td>

            <td><input type="text" name="proof_id_number[]" class="form-control" required></td>

            <td>
                <select name="purpose[]" class="form-control" required>
                    <option value="">Purpose</option>
                    <option>General Visit</option>
                    <option>Meeting</option>
                    <option>Interview</option>
                    <option>Document Submission</option>
                    <option>Verification / Approval</option>
                    <option>Event Visit</option>
                    <option>Personal Visit</option>
                    <option>Site Inspection</option>
                    <option>Maintenance / Service</option>
                    <option>Other</option>
                </select>
            </td>

            <td><input type="date" name="visit_date[]" class="form-control" required></td>
            <td><input type="time" name="visit_time[]" class="form-control" required></td>

            <td><input type="text" name="vehicle_no[]" class="form-control" ></td>
            
            <td><select name="vehicle_type[]" class="form-control">
                <option value="">-- Select Vehicle Type --</option>
                <option>Bike</option>
                <option>Car</option>
                <option>Van</option>
                <option>Bus</option>
                <option>Auto</option>
                <option>Truck</option>
                </select></td>

            <td><textarea name="description[]" class="form-control" rows="2" ></textarea></td>
            
            <td class="text-center">
                <button type="button" class="btn btn-outline-primary btn-sm uploadBtn">
                    <i class="fas fa-upload"></i>
                </button>
                <input type="file" name="vehicle_id_proof[]" class="fileInput d-none">
            </td>

            <td class="text-center">
                <button type="button" class="btn btn-outline-primary btn-sm uploadBtn">
                    <i class="fas fa-upload"></i>
                </button>
                <input type="file" name="visitor_id_proof[]" class="fileInput d-none">
            </td>

            <td>
                <button type="button" class="btn btn-danger btn-sm removeRow"> <i class="fa-solid fa-user-xmark"></i> </button>
            </td>
        </tr>
    `;

    $("#visitorGrid tbody").append(row);
});

$(document).on('click', '.removeRow', function(){
    $(this).closest('tr').remove();
});
</script>


<!-- AJAX Submit -->
<script>
$("#visitorForm").submit(function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "<?= base_url('/visitorequest/create_group')?>",
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,

        success: function(res){
            if(res.status === "success"){
                $("#visitorForm")[0].reset();
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    title: 'Visitor Saved Successfully',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

                    // Send mails only for approved ones
                if(res.submit_type === 'admin'){
                    res.mail_data.forEach(item => {
                        sendMail(item);
                    });
                }
            }
        },

        error: function(){
            Swal.fire({
                position: 'top-end',
                toast: true,
                icon: 'error',
                title: 'Something went wrong!',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        }
    });
});


// Mail Function Calls 
function sendMail(postData) {
    $.ajax({
        url: "<?= base_url('/send-email') ?>",
        type: "POST",
        data: postData,
        dataType: "json",
        success: function (mailRes) {
            // console.log("Mail Sent:", mailRes);
        },
        error: function () {
            // console.log("Email sending failed");
        }
    });
}


$(document).on('click', '.uploadBtn', function () {
    $(this).closest('td').find('.fileInput').click();
});
</script>
