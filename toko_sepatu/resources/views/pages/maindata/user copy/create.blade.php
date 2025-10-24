@extends('layouts.app')
<style>
    .container-new {
    max-width: 1400px; /* wider than bootstrap container */
    width: 100%;
    margin-left: auto;
    margin-right: auto;
    padding-left: 24px;
    padding-right: 24px;
    box-sizing: border-box;
}
</style>
@section('content')
<form method="POST" action="/users/store" enctype="multipart/form-data">
  @csrf
  <div class="container-new">
    <div class="row">
      {{-- left column (slightly narrower now) --}}
      <div class="col-lg-6 col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">User Info</h4>

            <div class="form-group">
              <label class="col-form-label">Username</label>
              <input type="text" class="form-control" name="name" placeholder="Username" required>
            </div>

            <div class="form-group">
              <label class="col-form-label">Alamat</label>
              <input type="text" class="form-control" name="adress" placeholder="Alamat" required>
            </div>

            <div class="form-group">
              <label class="col-form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
              <label class="col-form-label">No Handphone</label>
              <input type="text" class="form-control" name="phonenumber" placeholder="Mobile number" required>
            </div>

          </div>
        </div>
      </div>

      {{-- right column (wider now) --}}
      <div class="col-lg-6 col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Account</h4>

            <div class="form-group">
              <label class="col-form-label">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
              <label class="col-form-label">Role</label>
              <select class="form-control" name="role" required>
                <option value="admin">Admin</option>
                <option value="technician">Technician</option>
                <option value="customer">Customer</option>
              </select>
            </div>

            <div class="form-group">
              <label class="col-form-label">Foto</label>
              <div class="row g-2">
                <div class="col-9">
                  <!-- clickable area styled like other inputs (acts as upload) -->
                  <label for="image" class="form-control mb-0 d-flex align-items-center" style="cursor:pointer;">
                    <span id="file-name-label">Upload Foto</span>
                  </label>
                </div>
                <div class="col-3">
                  <!-- filename display, same style/size as other inputs -->
                  <input type="text" id="file-name-display" class="form-control" readonly placeholder="No file">
                </div>
              </div>

              <input type="file" id="image" name="image" style="display:none;"
                onchange="(function(f){ document.getElementById('file-name-label').textContent = f?.name || 'Upload Foto'; document.getElementById('file-name-display').value = f?.name || ''; })(this.files[0]);">
            </div>

            <input type="hidden" name="is_active" value="active">

            <div class="mt-3">
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button type="reset" class="btn btn-dark">Cancel</button>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</form>
@endsection