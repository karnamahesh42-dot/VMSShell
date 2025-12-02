       <?= $this->include('/dashboard/layouts/header') ?>
     
       <?= $this->include('/dashboard/layouts/sidebar') ?>
       <style>
        /* Prevent overlap */
.dashboard-box {
  position: relative;
  overflow: hidden;
  border-radius: 15px;
  color: #000000ff;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  padding-bottom: 10px;
}

/* Hover animation */
.dashboard-box:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 25px rgba(65, 58, 58, 0.2);
}

/* Title beautification */
.box-title {
  font-size: 18px;
  font-weight: bold;
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Subtitle */
.box-subtitle {
  margin-top: 8px;
  font-size: 14px;
  opacity: 0.9;
  

}

/* Left icon styling */
.icon-left {
  font-size: 26px;
}

/* Background big icon */
.icon-bg {
  position: absolute;
  top: 15px;
  right: 10px;
  opacity: 0.25;
  font-size: 70px;
  transition: 0.4s ease;
}

/* Big icon hover movement */
.dashboard-box:hover .icon-bg {
  transform: scale(1.1) rotate(8deg);
  opacity: 0.35;
}

/* Footer link animation */
.hover-link {
  color: #0d6efd !important;
  font-weight: 600;
  transition: padding-left 0.3s ease;
}

.hover-link:hover {
  padding-left: 6px;
}

       </style>
     
       <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page"></li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">

               <!-- /.col-md-6 -->
  <?php if($_SESSION['role_id'] == '1'){ ?>
    <div class="col-lg-3 col-6 col-md-2 mb-2">
      <div class="dashboard-box bg-warning animated-box p-3">
        <div class="inner">
          <h3 class="box-title">
            User
          </h3>
          <p class="box-subtitle">User Overview</p>
        </div>
        <div class="icon icon-bg">
          <i class="fa-solid fa-user"></i>
        </div>
        <a href="<?= base_url('userlist') ?>" class="small-box-footer hover-link" style="text-align: center;">
          More info  <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <?php } ?>
              <!-- /.col-md-6 -->
 <?php if($_SESSION['role_id'] !== '4' ){?>
  <!-- /.col-md-6 -->
  <div class="col-lg-3 col-6 col-md-2 mb-2">
    <div class="dashboard-box bg-warning animated-box p-3">
      <div class="inner">
        <h3 class="box-title">
          Visitor Request
        </h3>
        <p class="box-subtitle"> Visitor Request Form</p>
      </div>
      <div class="icon icon-bg">
        <i class="fa-brands fa-wpforms"></i>
      </div>
      <a href="<?= base_url('visitorequest') ?>" class="small-box-footer hover-link" style="text-align: center;">
        More info  <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
    <!-- /.col-md-6 -->

                  <!-- /.col-md-6 -->

          <div class="col-lg-3 col-6 col-md-2 mb-2">
            <div class="dashboard-box bg-warning animated-box p-3">
              <div class="inner">
                <h6 class="box-title">
                 Group Request
                </h6>
                <p class="box-subtitle"> Group Request Form</p>
              </div>
              <div class="icon icon-bg">
               <i class="fa-brands fa-wpforms"></i>
              </div>
              <a href="<?= base_url('group_visito_request') ?>" class="small-box-footer hover-link" style="text-align: center;">
                More info  <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
              <!-- /.col-md-6 -->
  <?php } ?>

        <?php if($_SESSION['role_id'] == '4' || $_SESSION['role_id'] == '1' ){?>
            <div class="col-lg-3 col-6 col-md-2 mb-2">
              <div class="dashboard-box bg-warning animated-box p-3">
                <div class="inner">
                  <h3 class="box-title">
                    Security Authorization
                  </h3>
                  <p class="box-subtitle">Security Authorization</p>
                </div>
                <div class="icon icon-bg">
                 <i class="fa-solid fa-qrcode"></i>
                </div>
                <a href="<?= base_url('security_authorization') ?>" class="small-box-footer hover-link" style="text-align: center;">
                  More info  <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          <?php } ?>

          <?php if($_SESSION['role_id'] == '4' || $_SESSION['role_id'] == '1' ){?>
                <div class="col-lg-3 col-6 col-md-2 mb-2">
                  <div class="dashboard-box bg-warning animated-box p-3">
                    <div class="inner">
                      <h3 class="box-title">
                        Security Authorized List
                      </h3>
                      <p class="box-subtitle">Security Authorized Visitor List</p>
                    </div>
                    <div class="icon icon-bg">
                     <i class="fa-solid fa-table-list"></i>
                    </div>
                    <a href="<?= base_url('authorized_visitors_list') ?>" class="small-box-footer hover-link" style="text-align: center;">
                      More info  <i class="fas fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
            <?php } ?>



            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
     
  <?= $this->include('/dashboard/layouts/footer') ?>