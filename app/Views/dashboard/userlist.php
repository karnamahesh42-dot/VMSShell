<?= $this->include('/dashboard/layouts/header') ?>
<?= $this->include('/dashboard/layouts/sidebar') ?>

<!--begin::App Main-->
<main class="app-main">

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Users</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item active">User List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->


<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Edit User</h5>
        
      </div>

      <form id="editUserForm">
        <?= csrf_field() ?>

        <div class="modal-body">

          <input type="hidden" id="edit_id" name="id">

          <div class="form-group">
            <label>Company</label>
            <input type="text" id="edit_company" name="company_name" class="form-control" readonly>

          </div>

          <div class="form-group">
            <label>Department</label>
            <select id="edit_department" name="department_id" class="form-control">
              <?php foreach ($departments as $dept): ?>
                <option value="<?= $dept['id'] ?>"><?= $dept['department_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
         
          <div class="form-group">
            <label>Name</label>
            <input type="text" id="name" name="name" class="form-control">
          </div>


          <div class="form-group">
            <label>Email</label>
            <input type="email" id="edit_email" name="email" class="form-control">
          </div>

          <div class="form-group">
            <label>Employee Code</label>
            <input type="text" id="edit_empcode" name="employee_code" class="form-control">
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
       <button type="button" class="btn btn-danger" onclick="$('#editUserModal').modal('hide')">Close</button>

        </div>

      </form>

    </div>
  </div>
</div>


    <div class="app-content">
        <div class="container-fluid">
                <div class="row d-flex justify-content-center">
             
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">User List</h3>

                                    <div class="card-tools">
                                    <div class="input-group input-group-sm mx-2">
                                    <!-- <input type="button" name="add" class="form-control float-right" placeholder="Search"> -->
                                    <a href="<?= base_url('user') ?>" class="btn btn-warning mt-1">New User</a>
                                    </div>
                                </div>
                               
                            </div>

                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped" id="userTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company</th>
                                            <th>Department</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (!empty($users)): ?>
                                            <?php $i = 1; foreach ($users as $user): ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    
                                                    <td><?= $user['company_name'] ?></td>
                                                    <td><?= $user['department_name'] ?></td>
                                                    <td><?= $user['name'] ?></td>
                                                    <td><?= $user['username'] ?></td>
                                                    <td><?= $user['role_name'] ?></td>
                                                    
                                                    <td>
                                                    <button class="btn btn-sm btn-primary editUserBtn" data-id="<?= $user['id'] ?>">Edit</button>

                                                    <button class="btn btn-sm 
                                                    <?= ($user['active']==1?'btn-warning':'btn-success') ?> toggleStatusBtn"
                                                    data-id="<?= $user['id'] ?>">
                                                    <?= ($user['active']==1?'Deactivate':'Activate') ?>
                                                    </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
               
                                
            </div>

        </div>
    </div>
</main>
<!--end::App Main-->

<?= $this->include('/dashboard/layouts/footer') ?>

<script>

// Load User Data into Modal
$(document).on("click", ".editUserBtn", function () {
    let userId = $(this).data("id");

    $.ajax({
        url: "<?= base_url('user/get/') ?>" + userId,
        type: "GET",
        dataType: "json",
        success: function(res) {

            $("#edit_id").val(res.id);
            $("#edit_company").val(res.company_name);
            $("#edit_department").val(res.department_id);
            $("#edit_email").val(res.email);
            $("#edit_empcode").val(res.employee_code);
            $("#name").val(res.name);
            $("#editUserModal").modal("show");
        }
    });
});


// Submit Edit Form
$("#editUserForm").on("submit", function(e){
    e.preventDefault();

    $.ajax({
        url: "<?= base_url('user/update') ?>",
        type: "POST",
        data: $(this).serialize(),
        dataType: "json",
        success: function(res){

            if (res.status === "success") {
                Swal.fire({
                    icon: "success",
                    title: "Updated Successfully",
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => location.reload(), 1500);

            } else {
                Swal.fire("Error", res.message, "error");
            }
        }
    });
});

$(".toggleStatusBtn").on("click", function () {
    let userId = $(this).data("id");

    $.ajax({
        url: "<?= base_url('user/toggleStatus') ?>",
        type: "POST",
        data: {
            id: userId,
            <?= csrf_token() ?>: "<?= csrf_hash() ?>"
        },
        dataType: "json",
        success: function(res){
            Swal.fire({
                icon: "success",
                title: res.message,
                timer: 1200,
                showConfirmButton: false
            });
            setTimeout(() => location.reload(), 1200);
        }
    });
});


</script>

