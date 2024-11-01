<div class="modal-content">
  <!-- Example of booking detail modal content -->
  <div class="modal-header border-0">
      <h5 class="modal-title fw-bold">Module Access</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <form id="module_access_form">
      @csrf
      <input type="hidden" name="userID" value="{{ $userID }}">
      <div class="input-group mb-3">
        <select name="module_code" class="form-select" required>
          <option value="">Choose</option>
          @foreach ($moduleAccessDetails as $moduleAccessDetails_data)
            @if (!in_array($moduleAccessDetails_data['code'], $access_code)) 
              <option value="{{$moduleAccessDetails_data['code']}}">{{$moduleAccessDetails_data['name']}}</option>
            @endif
          @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th>Module</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($moduleAccess as $item)
          <tr>
            <td>{{ $item['module_name'] }}</td>
            <td><button type="button" class="btn btn-sm btn-danger delete_access" data-user-id="{{ $userID }}" data-access-id="{{ $item['id'] }}">Delete</button></td>
          </tr>            
        @endforeach
      </tbody>
    </table>
  </div>
</div>