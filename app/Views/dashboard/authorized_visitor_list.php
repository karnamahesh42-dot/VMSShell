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
                            <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-md-2">
                                                <label class="form-label">Request Code</label>
                                            <input type ='text' id="requestcode" placeholder="Enter GV-Code" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">V-Code</label>
                                            <input type ='text' id="v_code" placeholder="Enter V-Code" class="form-control">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">Company</label>
                                                <select id="filterCompany" class="form-select">
                                                    <option value="">All</option>
                                                    <option value="UKMPL">UKMPL</option>
                                                    <option value="DHPL">DHPL</option>
                                                    <option value="ETPL">ETPL</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">Department</label>
                                                <select id="filterDepartment" class="form-select">
                                                    <option value="">All</option>
                                                    <?php foreach ($departments as $dept): ?>
                                                        <option value="<?= $dept['department_name'] ?>">
                                                            <?= $dept['department_name'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">Security Status</label>
                                                <select id="filterSecurity" class="form-select">
                                                    <option value="">All</option>
                                                    <option value="0">Not Entered</option>
                                                    <option value="1">Inside</option>
                                                    <option value="2">Completed</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 d-flex align-items-end gap-1">

    <!-- Search Button -->
    <button class="btn btn-primary" onclick="loadAuthorizedVisitors()" title="Search">
        <i class="fas fa-search"></i>
    </button>

    <!-- Reset Button -->
    <button class="btn btn-secondary" onclick="resetFilters()" title="Reset Filters">
        <i class="fas fa-sync-alt"></i>
    </button>

    <!-- Export Button -->
    <button class="btn btn-success" onclick="exportTable()" title="Export Data">
        <i class="fas fa-file-export"></i>
    </button>
</div>
                                        </div>
                                    </div>
                                </div>

                            <div class="table-responsive">                            
                                <table class="table table-hover mb-0">
                                    <thead class="table-light" id="authorizedVisitorTablehead">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Request Code</th>
                                            <th>V-Code</th>
                                            <th>Company</th>
                                            <th>department</th>
                                            <th>Rquested By</th>
                                            <th>Visitor</th>
                                            <th>Contact</th>
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
})

function loadAuthorizedVisitors() {
    $.ajax({
        url: "<?= base_url('/security/authorized_visitors_list_data') ?>",
        type: "GET",
        dataType: "json",
        data: {
            company: $("#filterCompany").val(),
            department: $("#filterDepartment").val(),
            securityCheckStatus: $("#filterSecurity").val(),
            requestcode:  $("#requestcode").val(),
            v_code:   $("#v_code").val()
        },
        success: function(res) {

            let tbody = $("#authorizedVisitorTable");
            tbody.empty();

            if (!res.length) {
                tbody.append(`
                    <tr>
                        <td colspan='13' class='text-center text-muted'>No authorized visitors found</td>
                    </tr>
                `);
                return;
            }

            res.forEach((v, index) => {

                let statusBadge = "";
                if (v.securityCheckStatus == 0) {
                    statusBadge = `<span class="badge bg-secondary">Not Entered</span>`;
                } 
                else if (v.securityCheckStatus == 1) {
                    statusBadge = `<span class="badge bg-warning text-dark">Inside</span>`;
                } 
                else {
                    statusBadge = `<span class="badge bg-success">Completed</span>`;
                }

                tbody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${v.header_code}</td>
                        <td>${v.v_code}</td>
                        <td>${v.company}</td>
                        <td>${v.department_name}</td>
                        <td>${v.created_by_name}</td>
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


function resetFilters() {
    $("#filterCompany").val('');
    $("#filterDepartment").val('');
    $("#filterSecurity").val('');
    $("#requestcode").val('');
     $("#v_code").val('');
    loadAuthorizedVisitors();
}

function exportTable() {
    let rows = [];
      
     $("#authorizedVisitorTablehead tr").each(function () {
        let cols = [];
        $(this).find("th").each(function () {
            cols.push($(this).text().trim());
        });
        if(cols.length > 0) rows.push(cols.join(","));
    });

    $("#authorizedVisitorTable tr").each(function () {
        let cols = [];
        $(this).find("td").each(function () {
            cols.push($(this).text().trim());
        });
        if(cols.length > 0) rows.push(cols.join(","));
    });

 
    let csvContent = "data:text/csv;charset=utf-8, " 
                     + rows.join("\n");
    console.log(csvContent);

    let a = document.createElement("a");
    a.href = encodeURI(csvContent);
    a.download = "authorized_visitors.csv";
    a.click();
}


</script>
