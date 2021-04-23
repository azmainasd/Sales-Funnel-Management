<!-- jQuery -->
<script src="{{ asset('admin-item/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin-item/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin-item/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('admin-item/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin-item/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('admin-item/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin-item/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin-item/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('admin-item/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin-item/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin-item/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin-item/dist/js/demo.js') }}"></script>

@section('js-section')
 @show
@section('scripts')
 @show

<script>
  /** add active class and stay opened when selected */
  var url = window.location;
  // for sidebar menu entirely but not cover treeview
  $('ul.nav-sidebar a').filter(function() {
      return this.href == url;
  }).addClass('active');
  $('ul.nav-sidebar a').filter(function() {
      return this.href == url;
  }).parent('.nav-item').addClass('active-item');
  // for treeview
  $('ul.nav-treeview a').filter(function() {
      return this.href == url;
  }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>