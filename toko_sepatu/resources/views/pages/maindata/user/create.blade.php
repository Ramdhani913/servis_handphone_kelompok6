@extends('layouts.app')

<style>
/* Full halaman tanpa batas lebar */
.container-new {
  max-width: 100%;
  width: 100%;
  margin: 0;
  padding: 40px 80px; /* tambah ruang kiri kanan */
  box-sizing: border-box;
}

/* Kolom kiri dan kanan biar full sejajar dan rata */
.col-lg-6, .col-md-6 {
  padding: 0 15px;
}

/* Card besar dan lebar penuh */
.card {
  border-radius: 16px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  width: 100%;
  height: 100%;
}

/* Card-body biar isi tidak sempit */
.card-body {
  padding: 40px;
}

/* Input besar dan full lebar */
.form-control {
  height: 56px;
  font-size: 16px;
  padding: 12px 18px;
  border-radius: 10px;
  width: 100%;
}

/* Label lebih tegas */
.col-form-label {
  font-size: 15px;
  font-weight: 600;
  margin-bottom: 8px;
  display: block;
}

/* Tombol besar dan proporsional */
.btn {
  padding: 14px 32px;
  font-size: 16px;
  border-radius: 10px;
}

/* Judul card */
.card-title {
  font-size: 22px;
  font-weight: 700;
  margin-bottom: 25px;
}

/* Jarak antar card */
.row {
  row-gap: 40px;
}

/* Row form bagian foto */
.g-2 {
  gap: 12px;
}

/* Biar halaman benar-benar full */
body, html {
  width: 100%;
  height: 100%;
  background-color: #f8f9fa;
}

/* Responsif untuk layar kecil */
@media (max-width: 992px) {
  .container-new {
    padding: 20px;
  }
  .card-body {
    padding: 20px;
  }
}
</style>

@section('content')
<form method="POST" action="/users/store" enctype="multipart/form-data">
  @csrf
  <div class="container-new">
    <div class="row">
      {{-- Kolom kiri --}}
      <div class="col-lg-6 col-md-6 grid-margin stretch-card">
        <div class="card w-100 h-100">
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

      {{-- Kolom kanan --}}
      <div class="col-lg-6 col-md-6 grid-margin stretch-card">
        <div class="card w-100 h-100">
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
              <div class="row g-2 align-items-center">
                <div class="col-8">
                  <label for="image" class="form-control mb-0 d-flex align-items-center" style="cursor:pointer;">
                    <span id="file-name-label">Upload Foto</span>
                  </label>
                </div>
                <div class="col-4">
                  <input type="text" id="file-name-display" class="form-control" readonly placeholder="No file">
                </div>
              </div>

              <input type="file" id="image" name="image" style="display:none;"
                onchange="(function(f){ 
                  document.getElementById('file-name-label').textContent = f?.name || 'Upload Foto'; 
                  document.getElementById('file-name-display').value = f?.name || ''; 
                })(this.files[0]);">
            </div>

            <input type="hidden" name="is_active" value="active">

            <div class="mt-4">
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
