<script>
  document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById('iconNavbarSidenav');
    const sidebar = document.getElementById('sidenav-main');

    if (toggle && sidebar) {
      toggle.addEventListener('click', function () {
        if (sidebar.classList.contains('g-sidenav-hidden')) {
          sidebar.classList.remove('g-sidenav-hidden');
        } else {
          sidebar.classList.add('g-sidenav-hidden');
        }
      });
    }
  });
</script>
