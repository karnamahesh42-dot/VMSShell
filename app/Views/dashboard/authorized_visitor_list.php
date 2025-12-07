<?= $this->include('/dashboard/layouts/sidebar') ?>
  <?= $this->include('/dashboard/layouts/navbar') ?>
     
   <main class="main-content" id="mainContent">
        <div class="container-fluid">

             <div class="row d-flex justify-content-center">
                <div class="col-md-12">

                  <!-- AUTHORIZED VISITOR LIST -->
                    <div class="card visitor-list-card">
                        <div class="card-header bg-primary text-white d-flex">
                            <h5 class="mb-0">
                                <i class="fas fa-users"></i> Authorized Visitor List
                            </h5>
                            <!-- <span class="badge bg-light text-success fw-bold" id="authCount">0</span> -->
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>V-Code</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Purpose</th>
                                            <th>Status</th>
                                            <th>Check-In</th>
                                            <th>Check-Out</th>
                                            <th>Spend Time</th>
                                        </tr>
                                    </thead>
                                    <tbody id="authorizedVisitorTable"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- AUTHORIZED VISITOR LIST  Card End -->

                </div>
            </div>

        </div>
    </main>

<?= $this->include('/dashboard/layouts/footer') ?>


<!-- JS -->
 <script>

    $(document).ready(function () {
        loadAuthorizedVisitors();
    });
 function loadAuthorizedVisitors() {
    $.ajax({
        url: "<?= base_url('/security/authorized_visitors_list_data') ?>",
        type: "GET",
        dataType: "json",
        success: function(res) {
        

            let tbody = $("#authorizedVisitorTable");
            tbody.empty();

            if (!res.length) {
                tbody.append(`
                    <tr>
                        <td colspan='8' class='text-center text-muted'>
                            No authorized visitors found
                        </td>
                    </tr>
                `);
                return;
            }

            $("#authCount").text(res.length);

            

            res.forEach((v, index) => {

                // Status Badge
                let statusBadge = "";
                if (v.securityCheckStatus == 0) {
                    statusBadge = `<span class="badge bg-secondary">Not Entered</span>`;
                } 
                else if (v.securityCheckStatus == 1) {
                    statusBadge = `<span class="badge bg-warning text-dark">Inside</span>`;
                } 
                else if (v.securityCheckStatus == 2) {
                    statusBadge = `<span class="badge bg-success">Completed</span>`;
                }

                tbody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${v.v_code}</td>
                        <td>${v.visitor_name}</td>
                        <td>${v.visitor_phone}</td>
                        <td>${v.purpose}</td>
                        <td>${statusBadge}</td>
                        <td>${v.check_in_time ?? '-'}</td>
                        <td>${v.check_out_time ?? '-'}</td>
                        <td>${v.spendTime ?? '-'}</td>
                    </tr>
                `);
            });
        }
    });
}

</script>
