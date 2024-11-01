@include('admin.partials.__header')
@include('admin.partials.__nav')
<script type="module">
    import QrScanner from "https://cdn.jsdelivr.net/npm/qr-scanner/qr-scanner.min.js";
    QrScanner.WORKER_PATH = "https://cdn.jsdelivr.net/npm/qr-scanner/qr-scanner-worker.min.js";

    document.addEventListener("DOMContentLoaded", () => {
        const videoElem = document.getElementById("qr-video");
        const scannedResultElem = document.getElementById("scanned_result");
        const startScannerBtn = document.getElementById("start_scanner");

        const qrScanner = new QrScanner(videoElem, result => {
            scannedResultElem.textContent = ` ${result}`;
            if(result != "") {
              $.ajax({
                type: "GET",
                url: "/admin/get_specific_user",
                data: {qrcode: result},
                headers: {
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                  let res = response[0];
                  $("#visitor_name").text(res.name)
                  $("#visitor_gender").text(res.gender)
                  $("#visitor_email").text(res.email)
                  $("#visitor_contact").text(res.contact)
                  $("#visitor_address").text(res.address)
                  
                  $('#scan_profile_modal').modal('show');
                }
              });
            }
            
            qrScanner.stop();
        });

        startScannerBtn.addEventListener("click", () => {
            qrScanner.start();
        });
    });
</script>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>QR Scanner</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">QR Scanner</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        
        <div class="" style="width: 100%;height:100%">
          <video id="qr-video" class="bg-dark" style="width:100%;height:400px"></video>
        </div>
        <div class="text-center">
          <button id="start_scanner" class="btn btn-primary mb-3 w-100">Start Scanner</button>
        </div>
        
    </section>
    <div
      class="modal fade"
      id="scan_profile_modal"
      tabindex="-1"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      role="dialog"
      aria-labelledby="modalTitleId"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">
              Result : <span id="scanned_result"></span>
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <span class="fw-bold">Name :</span> <span id="visitor_name"></span> <br>
                <span class="fw-bold">Gender :</span> <span id="visitor_gender"></span><br>
                <span class="fw-bold">Email :</span> <span id="visitor_email"></span><br>
                <span class="fw-bold">Contact Number :</span> <span id="visitor_contact"></span><br>
                <span class="fw-bold">Address :</span> <span id="visitor_address"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>

@include('admin.partials.__footer')
