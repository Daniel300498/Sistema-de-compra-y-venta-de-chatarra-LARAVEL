 <!-- Vendor JS Files -->
 <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
 <script src="{{ asset('assets/vendor/echarts/echarts.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/quill/quill.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>

 <!-- Template Main JS File -->
 <script src="{{ asset('assets/js/main.js')}}"></script>
 <script src="{{ asset('assets/vendor/datatables/dataTables.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js')}}"></script>
 <script src="{{ asset('assets/vendor/select2/select2.min.js')}}"></script>

 <script>
    
  // Función para mover el scroll
  function scrollToActiveMenu() {
    var activeMenuItem = $('#sidebar .active');
    if (activeMenuItem.length) {
      var menuSection = $('#sidebar');
      var menuSectionPosition = menuSection.offset().top;
      var activeMenuItemPosition = activeMenuItem.offset().top;
      $('.sidebar').animate({
        scrollTop: activeMenuItemPosition - menuSectionPosition - 100
      }, 100);
    }
    else{
        var activeMenuItem = $('#sidebar .menu-activo');
        if (activeMenuItem.length) {
            var menuSection = $('#sidebar');
            var menuSectionPosition = menuSection.offset().top;
            var activeMenuItemPosition = activeMenuItem.offset().top;
            $('.sidebar').animate({
                scrollTop: activeMenuItemPosition - menuSectionPosition - 100
            }, 100);
        }
    }
  }

  // Llamar a la función después de cargar la página
  scrollToActiveMenu();

  // Llamar a la función después de hacer clic en un enlace del menú
  $('#sidebar .menu-activo').on('click', function() {
    setTimeout(scrollToActiveMenu, 500);
  });
  $('#sidebar .active').on('click', function() {
    setTimeout(scrollToActiveMenu, 500);
  });


 </script>
 @include('sweetalert::alert')
 @yield('scripts')

<script>
(function () {
    var submenus = ['menu-proveedores', 'menu-transporte', 'menu-clientes', 'menu-admin'];

    submenus.forEach(function (id) {
        var toggle = document.querySelector('[data-sidebar-target="' + id + '"]');
        if (!toggle) return;

        toggle.addEventListener('click', function (e) {
            e.preventDefault();

            var target = document.getElementById(id);
            if (!target) return;

            var isOpen = target.classList.contains('submenu-open');

            // Cerrar todos
            submenus.forEach(function (otherId) {
                var other = document.getElementById(otherId);
                var otherToggle = document.querySelector('[data-sidebar-target="' + otherId + '"]');
                if (other) other.classList.remove('submenu-open');
                if (otherToggle) otherToggle.classList.add('collapsed');
            });

            // Si estaba cerrado, abrir
            if (!isOpen) {
                target.classList.add('submenu-open');
                toggle.classList.remove('collapsed');
            }
        });
    });
}());
</script>