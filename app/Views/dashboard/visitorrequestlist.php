<?= $this->include('/dashboard/layouts/header') ?>
<?= $this->include('/dashboard/layouts/sidebar') ?>

<!--begin::App Main-->
<main class="app-main">

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Visitor Request List</h3></div>
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
        
                    <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Visitor Request List</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                            <!-- <input type="button" name="add" class="form-control float-right" placeholder="Search"> -->
                            
                            <a href="<?= base_url('visitorequest') ?>" class="btn btn-warning "> New Request</a>
                            </div>
                        </div>
                        </div>
                        <!-- /.card-header -->
                         <!-- /.card-body -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap" id="visitorTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>S No</th>
                                            <th>Visitor</th>
                                            <th>Visit Date</th>
                                            <th>Purpose</th>
                                            <th>Phone</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th style="width:150px;">Actions</th>
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
// Handle Approve / Reject buttons
$(document).on("click", ".approvalBtn", function () {
    let id = $(this).data("id");
    let status = $(this).data("status");

    approval(id, status);
});

function approval(id, status) {

    $.ajax({
        url: "<?= base_url('/approvalprocess') ?>",
        type: "POST",
        data: { id: id, status: status },
        dataType: "json",
        success: function (res) {

            if (res.status === "success") {

                Swal.fire({
                position: 'top-end',
                toast: true,
                icon: 'success',
                title: 'Action Completed', 
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                backgroundColor: '#cf4040ff',
                titleColor: '#fff',
                }) 
                loadVisitorList();  // Refresh table immediately
            } else {
                alert("Failed to update!");
            }
        }
    });
}

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
                        <button class="btn btn-success btn-sm approvalBtn" data-id="${item.id}" data-status="approved">Approve</button>
                        <button class="btn btn-danger btn-sm approvalBtn" data-id="${item.id}" data-status="rejected">Reject</button>
                    `;
                } else {
                    actions = `<span class="text-muted">--</span>`;
                }

                rows += `
                    <tr>
                        <td>${i++}</td>
                        <td>${item.visitor_name}</td>
                        <td>${item.visit_date}</td>
                        <td>${item.purpose}</td>
                        <td>${item.visitor_phone}</td>
                        <td>${item.description ?? ''}</td>
                        <td>${statusBadge}</td>
                        <td>${actions}</td>
                    </tr>
                `;
            });

            $("#visitorTable tbody").html(rows);
        }
    });
}

</script>

