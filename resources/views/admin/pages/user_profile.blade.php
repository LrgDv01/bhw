<div class="modal-content">
  <div class="modal-header border-0">
      <h5 class="modal-title fw-bold">User Data</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <div class="d-flex">
        <div id="qrcode" class="me-2">
          <img id="myQR" src='data:image/png;base64,{{base64_encode(QrCode::format('png')->size(150)->generate($user_data->code))}}'/>
        </div>
        <div>
            <b>Username:</b> <span id="user_contact">{{ $user_data->Username }}</span> <br>
            <b>Name:</b> <span id="user_name">{{ $user_data->name }}</span> <br>
            <b>Email:</b> <span id="user_email">{{ $user_data->email }}</span> <br>
        </div>
    </div>
  </div>
</div>
