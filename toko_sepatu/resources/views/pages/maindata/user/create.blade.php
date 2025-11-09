@extends('layouts.app')
<style>
.container-new {
    max-width: 100%; /* ubah dari 1400px ke full width */
    width: 100%;
    margin: 0 auto;
    padding-left: 24px;
    padding-right: 24px;
    box-sizing: border-box;
}

/* buat kolom kiri dan kanan lebih proporsional di layar lebar */
.col-18-9 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 15px;
}

/* biar kolom responsif di layar kecil */
@media (max-width: 992px) {
  .col-18-9 {
    flex: 0 0 100%;
    max-width: 100%;
  }
}
</style>

@section('content')
<form method="POST" action="/users/store" enctype="multipart/form-data">
  @csrf
  <div class="container-new">
    <div class="row">
      {{-- left column --}}
      <div class="col-18-9 col-md-6 grid-margin stretch-card">
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

      {{-- right column --}}
      <div class="col-18-9 col-md-6 grid-margin stretch-card">
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
                  <label for="image" class="form-control mb-0 d-flex align-items-center" style="cursor:pointer;">
                    <span id="file-name-label">Upload Foto</span>
                  </label>
                </div>
                <div class="col-1">
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
