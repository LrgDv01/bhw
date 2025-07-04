
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
  <!-- Bootstrap JS (Ensure Bootstrap is included in your layout) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
  @if(Request::routeIs('admin.dashboard') || Request::routeIs('admin.midwife.dashboard') || Request::routeIs('bhw.dashboard'))
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <!-- Map Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
      crossorigin="anonymous"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.14.0/mapbox-gl.js"></script>
    <script src="{{ URL::asset('js/admin/geomap.js')}}"></script> 

    <!-- Chart Script -->
    <script type="module" src="{{ URL::asset('js/admin/womensChart.js')}}"></script>
    <script type="module" src="{{ URL::asset('js/admin/dewormingChart.js')}}"></script>
    <script type="module" src="{{ URL::asset('js/admin/pregnantChart.js')}}"></script> 
    <script type="module" src="{{ URL::asset('js/admin/contraceptiveMethodChart.js')}}"></script> 
    <script type="module" src="{{ URL::asset('js/admin/immunizationChart.js')}}"></script>
  @endif

    <script type="module" src="{{ URL::asset('js/admin/analytics/censusCharts.js')}}"></script>
    <script type="module" src="{{ URL::asset('js/admin/analytics/maternalCareCharts.js')}}"></script> 
    <script type="module" src="{{ URL::asset('js/admin/analytics/dewormingCharts.js')}}"></script>  
    <script type="module" src="{{ URL::asset('js/admin/analytics/familyFlanningCharts.js')}}"></script> 
    <script type="module" src="{{ URL::asset('js/admin/analytics/wReproductiveAgeCharts.js')}}"></script> 
    <script type="module" src="{{ URL::asset('js/admin/analytics/immunizationCharts.js')}}"></script> 


 
  <script src="{{ URL::asset('js/user/settings.js')}}"></script> 
  <script src="{{ URL::asset('js/user/user.js')}}"></script> 
  <script src="{{ URL::asset('js/app.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ URL::asset('theme/assets/js/main.js')}}"></script>
  <script src="{{ URL::asset('js/global.js') }}"></script>
  <script src="{{ URL::asset('js/lightbox.js') }}"></script>


</body>

</html>