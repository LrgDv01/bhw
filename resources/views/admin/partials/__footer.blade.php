
  <!-- ======= Footer ======= -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ URL::asset('theme/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ URL::asset('theme/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ URL::asset('theme/assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{ URL::asset('theme/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{ URL::asset('theme/assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ URL::asset('theme/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ URL::asset('theme/assets/vendor/php-email-form/validate.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>

  @if(Request::routeIs('admin.dashboard'))
    <!-- Map Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
      crossorigin="anonymous"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.14.0/mapbox-gl.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
  @endif

  <!-- Template Main JS File -->
  <script src="{{ URL::asset('theme/assets/js/main.js')}}"></script>
  <script src="{{ URL::asset('js/global.js') }}"></script>
  <script src="{{ URL::asset('js/lightbox.js') }}"></script>
  <script src="{{ URL::asset('js/admin/settings.js')}}"></script>
  <script src="{{ URL::asset('js/admin/users.js')}}"></script> 
  <script src="{{ URL::asset('js/admin/app.js')}}"></script>
  <script src="{{ URL::asset('js/admin/womensChart.js')}}"></script>
  <script src="{{ URL::asset('js/admin/childsChart.js')}}"></script>
  <script src="{{ URL::asset('js/admin/geomap.js')}}"></script> 
  <script src="{{ asset('js/admin/dashboard.js') }}"></script>
</body>

</html>