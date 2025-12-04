
<!-- Footer -->
<footer class="footer" id="footer" >
  <strong> © 2014-2025 <a href="https://adminlte.io" class="text-decoration-none">Ushakiran Movies Private Limited.</a> </strong> All rights reserved.
</footer>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const mobileToggle = document.getElementById('mobileSidebarToggle');
const collapseBtn = document.getElementById('sidebarCollapse');
const mainContent = document.getElementById('mainContent');
const topbar = document.getElementById('topbar');
const footer = document.getElementById('footer');

// Mobile toggle
mobileToggle?.addEventListener('click', () => {
  sidebar.classList.toggle('open');
  overlay.classList.toggle('active');
});

overlay?.addEventListener('click', () => {
  sidebar.classList.remove('open');
  overlay.classList.remove('active');
});

// Desktop collapse
collapseBtn?.addEventListener('click', () => {
  sidebar.classList.toggle('closed');
  mainContent.classList.toggle('expanded');
  topbar.classList.toggle('collapsed');
  footer.classList.toggle('expanded');
});

</script>