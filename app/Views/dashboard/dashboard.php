
  <?= $this->include('/dashboard/layouts/sidebar') ?>
  <?= $this->include('/dashboard/layouts/navbar') ?>
        
      <!-- Main Content -->
      <main class="main-content" id="mainContent">
        <div class="container-fluid">
          <!-- ROW 1: Small Cards -->
            <section class="dash-row">
              <?php foreach($smallCards as $c): ?>
                  <div class="card-dash-sm <?= $c['color'] ?>">
                      <div class="left">
                          <div class="title"><?= esc($c['title']) ?></div>
                          <div class="value"><?= esc($c['value']) ?></div>
                      </div>
                      <div class="right">
                          <i class="fa <?= esc($c['icon']) ?> fa-2x"></i>
                      </div>
                  </div>
              <?php endforeach; ?>
            </section>
          <!-- ROW 2: Medium Cards -->
          <section class="dash-row row-medium mb-3">
            <?php
            $meds = [
              ['title'=>'Today Visitors','desc'=>'32 people visited today.'],
              ['title'=>'This Week','desc'=>'142 visitors this week.'],
              ['title'=>'This Month','desc'=>'530 visitors this month.'],
              ['title'=>'Alerts','desc'=>'No security alerts.']
            ];
            foreach($meds as $m): ?>
            <div class="card-dash card-medium">
              <div class="title"><?= esc($m['title']) ?></div>
              <div class="muted mt-2"><?= esc($m['desc']) ?></div>
            </div>
            <?php endforeach; ?>
          </section>

          <!-- ROW 3: Pending + Quick Links -->
          <section class="dash-row row-large mb-3">
            <div class="card-dash card-large">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <h4 class="mb-0">Pending Approvals</h4>
                  <div class="muted">Requests that need action</div>
                </div>
                <div><a href="<?= base_url('visitorequestlist') ?>" class="btn btn-sm btn-outline-primary">View All</a></div>
              </div>
          <ul class="pending-list mt-2">
              <?php if (!empty($pendingList)): ?>
                  <?php foreach ($pendingList as $item): ?>
                      <li onclick="view_visitor(<?= $item['id'] ?>)" style="cursor:pointer;">
                          
                          <div>
                              <!-- GV Code -->
                              <div class="fw-700">
                                  <?= $item['header_code'] ?>
                              </div>

                              <!-- Purpose + date + persons -->
                              <small class="muted">
                                  <?= $item['purpose'] ?> • 
                                  <?= $item['requested_date'] ?> <?= $item['requested_time'] ?> •
                                  <?= $item['total_visitors'] ?> Persons
                              </small>
                          </div>

                          <div class="text-end">
                              <span class="badge-pending">Pending</span>
                          </div>

                      </li>
                  <?php endforeach; ?>
              <?php else: ?>
                  <li>
                      <div class="text-center text-muted w-100">No pending requests</div>
                  </li>
              <?php endif; ?>
          </ul>

            </div>
            <div class="card-dash card-large">
              <h4 class="mb-3">Quick Links</h4>
              <div class="quick-links">
                <a href="<?= base_url('visitorequest') ?>"><i class="bi bi-person-plus me-2"></i> Create Visitor Request</a>
                <a href="<?= base_url('group_visito_request') ?>"><i class="bi bi-people me-2"></i> Create Group Request</a>
                <a href="<?= base_url('authorized_visitors_list') ?>"><i class="bi bi-card-checklist me-2"></i> Authorized Visitors</a>
                <a href="<?= base_url('security_authorization') ?>"><i class="bi bi-shield-lock-fill me-2"></i> Security Authorization</a>
                <a href="<?= base_url('userlist') ?>"><i class="bi bi-gear me-2"></i> User Management</a>
              </div>
            </div>
          </section>

          <!-- Example Table -->
          <div class="card-dash mb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <h5 class="mb-0">Recent Visitor Entries</h5>
              <small class="muted">Latest 10</small>
            </div>
            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Visitor</th><th>Phone</th><th>Purpose</th><th>V-Code</th><th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>John Doe</td><td>9876543210</td><td>Meeting</td><td>RFC-202512</td><td><span class="badge badge-success">Approved</span></td>
                  </tr>
                  <tr>
                    <td>Mary Smith</td><td>9911223344</td><td>Interview</td><td>RFC-202513</td><td><span class="badge badge-warning">Pending</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </main>

  <?= $this->include('/dashboard/layouts/footer') ?>